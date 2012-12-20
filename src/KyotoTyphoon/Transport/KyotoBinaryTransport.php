<?php

namespace KyotoTyphoon\Transport;

use KyotoTyphoon\KyotoTransport;
use KyotoTyphoon\Interfaces\KyotoTransportInterface;

class KyotoBinaryTransport extends KyotoTransport implements KyotoTransportInterface
{
	public function __construct(Array $options){
        parent::__construct($options);
	}
}
