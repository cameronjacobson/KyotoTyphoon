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
}
