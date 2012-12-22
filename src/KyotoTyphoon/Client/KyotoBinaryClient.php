<?php

namespace KyotoTyphoon\Client;

use \KyotoTyphoon\Interfaces\KyotoClientInterface;
use \KyotoTyphoon\Transport\KyotoBinaryTransport;

use \KyotoTyphoon\KyotoRequest as Request;
use \KyotoTyphoon\KyotoResponse as Response;

use \KyotoTyphoon\KyotoEvent;

class KyotoBinaryClient implements KyotoClientInterface
{
	private $transport;
	public $emitter;

	public function __construct(Array $options){
		$this->transport = new KyotoBinaryTransport($options);
		$this->emitter = new KyotoEvent();
	}

	public function replication(){}

	public function play_script(){}

	public function set_bulk(){}

	public function remove_bulk(){}

	public function get_bulk(){}
}
