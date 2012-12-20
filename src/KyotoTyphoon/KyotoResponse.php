<?php

namespace KyotoTyphoon;

class KyotoResponse
{
	public $host = 'localhost';
	public $port = '1978';
	public $ctype = 'text/tab-separated-values';
	public $encoding = 'B';
	private $headers = array();

	public setEncoding($encoding = 'B'){
		if(in_array($encoding, array('B', 'Q', 'U'))){
			$this->encoding = $encoding;
		}
	}

	public setHost($host){
		$this->setHeader('Host', $host.':'.$this->port);
	}

	public setPort($port){
		$this->port = $port;
	}

	public setContentType($contentType){
		$this->setHeader('Content-Type', $contentType);
	}

	public setContentLength($length){
		$this->clength = $length;
	}

	private function setHeader($key, $value){
		$this->headers[$key] = $value;
	}

	private function removeHeader($key){
		@unset($this->headers[$key]);
	}

	private function initRequest(){
		$this->headers = array($action.' '.$path.' HTTP/1.0');
		$this->setHeader('Host',$this->host.':'.$this->port);
		$this->setHeader('Content-Type',$this->ctype);
		$this->setHeader('Content-Length',$length);
	}

	private function doAction(){

	}

	private function parseResponse(){
		$response = 
	}
}
