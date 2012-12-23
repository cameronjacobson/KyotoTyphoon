<?php

namespace KyotoTyphoon\Transport;

use KyotoTyphoon\KyotoTransport;
use KyotoTyphoon\Interfaces\KyotoTransportInterface;

use KyotoTyphoon\KyotoRequest as Request;
use KyotoTyphoon\KyotoResponse as Response;

class KyotoRestTransport extends KyotoTransport implements KyotoTransportInterface
{
	public function __construct(Array $options = []){
		parent::__construct($options);
	}

	private function generateBody(Request $request){
		$body = '';
		switch($request->command){
			case 'GET':
			case 'HEAD':
			case 'DELETE':
			default:
				break;
			case 'PUT':
				$body = $request->params[0]['value'];
				break;
		}
		return $body;
	}

	private function getContentLength($reqBody){
		return 'Content-Length: '.(strlen($reqBody))."\r\n";
	}

	private function initHeaders(Request $request){
		$headers = $request->command.' /'.$request->params[0]['key'].' HTTP/1.0'."\r\n";
		$headers.= 'Host: '.$this->host.':'.$this->port."\r\n";
		$headers.= 'Accept: */*'."\r\n";
		switch($request->command){
			case 'GET':
			case 'HEAD':
			case 'DELETE':
			default:
				break;
			case 'PUT':
				$headers .= 'Content-Type: text/plain';
				if(isset($request->params[0]['mode']) && in_array($request->params[0]['mode'],array('set', 'add', 'replace'))){
					$headers .= 'X-Kt-Mode: '.$request->params[0]['mode']."\r\n";
				}
				if(isset($request->params[0]['xt']) && is_numeric($request->params[0]['xt'])){
					$headers .= 'X-Kt-Xt: '.$request->params[0]['xt']."\r\n";
				}
				break;
		}
		return $headers;
	}

	public function generateHeaders(Request $request){
		$headers = [];
		switch($request->command){
			case 'GET':
			case 'HEAD':
			case 'DELETE':
			default:
				break;
			case 'PUT':
				$headers[] = 'Content-Type: text/plain';
				if(isset($request->params[0]['mode']) && in_array($request->params[0]['mode'],array('set', 'add', 'replace'))){
					$headers[] = 'X-Kt-Mode: '.$request->params[0]['mode'];
				}
				if(isset($request->params[0]['xt']) && is_numeric($request->params[0]['xt'])){
					$headers[] = 'X-Kt-Xt: '.$request->params[0]['xt'];
				}
				break;
		}
		return $headers;
	}

	private function dispatchRequest($out){
		$buff = '';
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

	public function send(Request $request, Response $response){
		$headers = $this->initHeaders($request);
		$body = '';
		if($request->command === 'PUT'){
			$body = $request->command == 'PUT' ? $this->generateBody($request) : '';
			$headers.= $this->getContentLength($body);
		}
		
		return $this->dispatchRequest($headers."\r\n".$body);
	}

/*
	public function send(Request $request, Response $response){
		$body = $this->generateBody($request);

		$headers = $this->generateHeaders($request);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->scheme.'://'.$this->host.'/'.$request->params[0]['key']);
		curl_setopt($ch, CURLOPT_PORT, $this->port);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $request->command);
		if(!empty($body)){
			curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
		}
		curl_setopt($ch, CURLOPT_VERBOSE, 0);
		curl_setopt($ch, CURLOPT_USERAGENT, 'myuseragent');
//		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec($ch);
		curl_close($ch);

		return $response;
	}
*/
}
