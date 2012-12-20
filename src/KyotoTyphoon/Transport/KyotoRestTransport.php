<?php

namespace KyotoTyphoon\Transport;

use KyotoTyphoon\KyotoTransport;
use KyotoTyphoon\Interfaces\KyotoTransportInterface;

class KyotoRestTransport extends KyotoTransport implements KyotoTransportInterface
{
	public function __construct(Array $options){
		parent::__construct($options);
	}
}
