<?php

namespace KyotoTyphoon\Transport;

use KyotoTyphoon\KyotoTransport;
use KyotoTyphoon\Interfaces\KyotoTransportInterface;

use KyotoTyphoon\KyotoRequest as Request;
use KyotoTyphoon\KyotoResponse as Response;

class KyotoRpcTransport extends KyotoTransport implements KyotoTransportInterface
{
	private $defaultEncoding = 'B';
	private $defaultContentType = 'text/tab-separated-values';
	private $validContentTypes = ['text/tab-separated-values','application/x-www-form-urlencoded','query-string'];
	private $validEncodings = ['base64'=>'B', 'quoted-printable'=>'Q', 'url-encoding'=>'U'];
	protected $conn;

	public function __construct(Array $options = []){
		parent::__construct($options);
		$this->setDefaultEncoding(@$options['encoding']);
		$this->setDefaultContentType(@$options['contentType']);
	}

	public function setConnection(){
	}

	public function setDefaultEncoding($encoding = ''){
		if(isset($this->validEncodings[$encoding])){
			$this->defaultEncoding = $this->validEncodings[$encoding];
		}
 		elseif(in_array($encoding, $this->validEncodings)){
			$this->defaultEncoding = $encoding;
		}
	}

	public function setDefaultContentType($contentType = ''){
		if(in_array($contentType,$this->validContentTypes)){
			$this->defaultContentType = strtolower($contentType);
		}
	}

	private function initHeaders(Request $request){
		$headers = 'POST /rpc/'.$request->command.' HTTP/1.0'."\r\n";
		$headers.= 'Host: '.$this->host.':'.$this->port."\r\n";
		$headers.= 'Content-Type: '.$this->defaultContentType.'; colenc='.$this->defaultEncoding."\r\n";
		return $headers;
	}

	private function getContentLength($reqBody){
		return 'Content-Length: '.(strlen($reqBody)+1)."\r\n";
	}

	private function parseHeaders(Response $response){
		
	}

	private function outbound(Request $request){
		$reqHeader = $this->initHeaders($request);
		$reqBody = $this->generateBody($request);
		$reqHeader.= $this->getContentLength($reqBody)."\r\n";
		return $reqHeader.$reqBody;
	}

	private function dispatchRequest($out){
		$buff = '';
		if($this->conn){
			$this->close();
		}
		$this->conn = stream_socket_client('tcp://'.$this->host.':'.$this->port,$errno,$errstr,30);
		if(!$this->conn){
			echo "$errstr ($errno)<br />\n";
			exit;
		}
		fwrite($this->conn, $out);
		while(!feof($this->conn)){
			$buff .= fgets($this->conn, 1024);
		}
		if($this->conn){
			fclose($this->conn);
		}
		return $buff;
	}

	public function close(){
	}

	private function generateBody(Request $request){
		$body = array();
		foreach((array)@$request->params[0] as $k=>$v){
			switch($this->defaultContentType){
				case 'text/tab-separated-values':
					$body[] = $this->encodeData($k).(!is_null($v) ? "\t".$this->encodeData($v) : '');
					break;
			}
		}
		return implode("\n",$body);
	}

	public function send(Request $request, Response $response){

		$body = $this->generateBody($request);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->scheme.'://'.$this->host.'/rpc/'.$request->command);
		curl_setopt($ch, CURLOPT_PORT, $this->port);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		if(!empty($body)){
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
		}
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: '.$this->defaultContentType.'; colenc='.$this->defaultEncoding,
			'Connection: Keep-Alive',
			'Keep-Alive: 300'
		));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec($ch);
//		curl_close($ch);

		return $response;
	}

	private function encodeData($data){
		switch($this->defaultEncoding){
			case 'B': // BASE64
				return base64_encode($data);
				break;
			case 'Q': // QUOTED PRINTABLE
				break;
			case 'U': // URL ENCODE
				return urlencode($data);
				break;
		}
	}
}
