<?php

namespace KyotoTyphoon;

class KyotoRequest
{
	private $headers = array();
	private $contentLength;

	public setContentLength($length){
		$this->contentLength = $length;
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
		$this->setHeader('Content-Length',$this->contentLength);
	}

	private function doAction(){

	}

	protected function send(){
		
	}
}
