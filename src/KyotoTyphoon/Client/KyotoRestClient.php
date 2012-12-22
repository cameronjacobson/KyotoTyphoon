<?php

namespace KyotoTyphoon\Client;

use \KyotoTyphoon\Interfaces\KyotoClientInterface;
use \KyotoTyphoon\Transport\KyotoRestTransport;

use \KyotoTyphoon\KyotoRequest as Request;
use \KyotoTyphoon\KyotoResponse as Response;

use \KyotoTyphoon\KyotoEvent;

class KyotoRestClient implements KyotoClientInterface
{
	private $transport;
	public $emitter;

	public function __construct(Array $options){
		$this->transport = new KyotoBinaryTransport($options);
		$this->emitter = new KyotoEvent();
	}

	public function GET(){}

	public function HEAD(){}

	public function PUT(){}

	public function DELETE(){}
}
