<?php

namespace KyotoTyphoon\Client;

use KyotoTyphoon\Interfaces\KyotoClientInterface;

class KyotoRpcClient implements KyotoClientInterface
{
	private $defaultEncoding = 'B';
	private $defaultContentType = 'text/tab-separated-values';
	private $validContentTypes = ['text/tab-separated-values','application/x-www-form-urlencoded','query-string'];
	private $validEncodings = ['base64'=>'B', 'quoted-printable'=>'Q', 'url-encoding'=>'U'];

	public function __construct(Array $options){
        $this->setDefaultEncoding(@$options['encoding']);
        $this->setDefaultContentType(@$options['contentType']);
	}

	public function setDefaultEncoding($encoding = ''){
		if(isset($this->validEncodings[$encoding])){
			$this->defaultEncoding = $this->validEncodings[$encoding];
		}
 		elseif(in_array($encoding, $this->validEncodings)){
			$this->defaultEncoding = $encoding;
		}
	}

	public function setDefaultContentType($contentType = ''){
		if(in_array($contentType,$this->validContentTypes)){
			$this->defaultContentType = strtolower($contentType);
		}
	}
}
