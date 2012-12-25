<?php

namespace KyotoTyphoon\Tests;

use \KyotoTyphoon\KyotoClient;
use \KyotoTyphoon\Client\KyotoBinaryClient;
use \KyotoTyphoon\Client\KyotoRestClient;
use \KyotoTyphoon\Client\KyotoRpcClient;
use \KyotoTyphoon\Transport\KyotoBinaryTransport;
use \KyotoTyphoon\Transport\KyotoRestTransport;
use \KyotoTyphoon\Transport\KyotoRpcTransport;

class KyotoClientTest extends \PHPUnit_Framework_TestCase
{
	private $client;

	public function setUp(){}

	public function getClient($type){
		return new KyotoClient([
			'url' => 'http://localhost:1978',
			'protocol' => $type
		]);
	}

	public function testClientConstructor(){
		$this->BinaryClient = $this->getClient('binary');
		$this->assertTrue($this->BinaryClient instanceof \KyotoTyphoon\KyotoClient);

		$this->RestClient = $this->getClient('rest');
		$this->assertTrue($this->RestClient instanceof \KyotoTyphoon\KyotoClient);

		$this->RpcClient = $this->getClient('rpc');
		$this->assertTrue($this->RpcClient instanceof \KyotoTyphoon\KyotoClient);
	}

	public function testBinaryProtocol(){
		$this->BinaryClient = $this->getClient('binary');

		$prop = new \ReflectionProperty('\KyotoTyphoon\Client\KyotoBinaryClient','transport');
		$prop->setAccessible(true);
		$binaryTransport = $prop->getValue($this->BinaryClient);
		$this->assertTrue($binaryTransport instanceof \KyotoTyphoon\Transport\KyotoBinaryTransport);

		$prop = new \ReflectionProperty('\KyotoTyphoon\KyotoClient','client');
		$prop->setAccessible(true);
		$binaryClient = $prop->getValue($this->BinaryClient);
		$this->assertTrue($binaryClient instanceof \KyotoTyphoon\Client\KyotoBinaryClient);

		$this->assertTrue(in_array('KyotoTyphoon\Interfaces\KyotoTransportInterface',(array)class_implements($binaryTransport)));
		$this->assertTrue(in_array('KyotoTyphoon\Interfaces\KyotoClientInterface',(array)class_implements($binaryClient)));
	}

	public function testRestProtocol(){
		$this->RestClient = $this->getClient('rest');

		$prop = new \ReflectionProperty('\KyotoTyphoon\Client\KyotoRestClient','transport');
		$prop->setAccessible(true);
		$restTransport = $prop->getValue($this->RestClient);
		$this->assertTrue($restTransport instanceof \KyotoTyphoon\Transport\KyotoRestTransport);

		$prop = new \ReflectionProperty('\KyotoTyphoon\KyotoClient','client');
		$prop->setAccessible(true);
		$restClient = $prop->getValue($this->RestClient);
		$this->assertTrue($restClient instanceof \KyotoTyphoon\Client\KyotoRestClient);

		$this->assertTrue(in_array('KyotoTyphoon\Interfaces\KyotoTransportInterface',(array)class_implements($restTransport)));
		$this->assertTrue(in_array('KyotoTyphoon\Interfaces\KyotoClientInterface',(array)class_implements($restClient)));
	}

	public function testRpcProtocol(){
		$this->RpcClient = $this->getClient('rpc');

		$prop = new \ReflectionProperty('\KyotoTyphoon\Client\KyotoRpcClient','transport');
		$prop->setAccessible(true);
		$rpcTransport = $prop->getValue($this->RpcClient);
		$this->assertTrue($rpcTransport instanceof \KyotoTyphoon\Transport\KyotoRpcTransport);

		$prop = new \ReflectionProperty('\KyotoTyphoon\KyotoClient','client');
		$prop->setAccessible(true);
		$rpcClient = $prop->getValue($this->RpcClient);
		$this->assertTrue($rpcClient instanceof \KyotoTyphoon\Client\KyotoRpcClient);

		$this->assertTrue(in_array('KyotoTyphoon\Interfaces\KyotoTransportInterface',(array)class_implements($rpcTransport)));
		$this->assertTrue(in_array('KyotoTyphoon\Interfaces\KyotoClientInterface',(array)class_implements($rpcClient)));
	}
}
