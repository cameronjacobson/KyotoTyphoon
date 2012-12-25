<?php

namespace KyotoTyphoon;

use \KyotoTyphoon\Interfaces\KyotoClientInterface;

class KyotoTransport
{
	protected $scheme;
	protected $host;
	protected $port;

	public function __construct(Array $options){}

	public function setScheme($scheme){
		$this->scheme = $scheme;
	}

	public function setHost($host){
		$this->host = $host;
	}

	public function setPort($port){
		$this->port = $port;
	}
}
