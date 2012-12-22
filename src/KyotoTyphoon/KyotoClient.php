<?php

namespace KyotoTyphoon;

use \KyotoTyphoon\Client\KyotoBinaryClient;
use \KyotoTyphoon\Client\KyotoRestClient;
use \KyotoTyphoon\Client\KyotoRpcClient;
use \KyotoTyphoon\Transport\KyotoBinaryTransport;
use \KyotoTyphoon\Transport\KyotoRestTransport;
use \KyotoTyphoon\Transport\KyotoRpcTransport;

class KyotoClient
{
	private $requests = array();
	private $responses = array();
	private $scheme = 'http';
	private $host = 'localhost';
	private $port = '1978';
	private $validSchemes = ['http', 'https'];
	private $protocol;
	private $transport;
	private $client;

	public function __construct(Array $options){
		$url = empty($options['url']) ? array() : parse_url($options['url']);
		$this->setScheme(@$url['scheme']);
		$this->setHost(@$url['host']);
		$this->setPort(@$url['port']);
		$this->protocol = @strtolower($options['protocol']) ?: 'rest';
		switch($this->protocol){
			case 'binary':
				$this->client = new KyotoBinaryClient($options);
				break;
			case 'rpc':
				$this->client = new KyotoRpcClient($options);
				break;
			default:
				$this->client = new KyotoRestClient($options);
				break;
		}
	}

	public function setScheme($scheme = ''){
		if(in_array($scheme, $this->validSchemes)){
			$this->scheme = $scheme;
		}
	}

	public function setHost($host = ''){
		$this->host = strtolower($host);
	}

	public function setPort($port = 0){
		if(!empty($port)){
			$this->port = (int)$port;
		}
	}

	public function __call($name,$args){
		$this->client->$name($args);
	}

	public function __get($name){
		return $this->client->$name;
	}

	public function __set($name,$value){
		$this->client->$name = $value;
	}
}
