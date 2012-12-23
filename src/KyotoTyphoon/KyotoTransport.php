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
		if($this->conn){
			$this->setConnection();
		}
	}

	public function setHost($host){
		$this->host = $host;
		if($this->conn){
			$this->setConnection();
		}
	}

	public function setPort($port){
		$this->port = $port;
		if($this->conn){
			$this->setConnection();
		}
	}
}
