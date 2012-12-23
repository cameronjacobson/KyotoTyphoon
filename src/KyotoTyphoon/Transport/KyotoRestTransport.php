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

    public function send(Request $request, Response $response){
        var_dump($request);
        var_dump($response);
    }
}
