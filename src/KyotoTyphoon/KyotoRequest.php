<?php

namespace KyotoTyphoon;

use KyotoTyphoon\KyotoEvent;

class KyotoRequest
{
	public $requestid;

	public function __construct(Array $params){
		$this->requestid = spl_object_hash($this);
	}
}
