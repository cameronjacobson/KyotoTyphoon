<?php

require_once(dirname(__DIR__).'/vendor/autoload.php');

use KyotoTyphoon\KyotoClient;

// Instantiate BINARY client
$binaryClient = new KyotoClient([
	'url'=>'https://localhost2:1979',
	'protocol'=>'binary'
]);
var_dump($binaryClient);

// Instantiate REST client
$restClient = new KyotoClient([
	'url'=>'https://localhost2:1979',
	'protocol'=>'rest'
]);
var_dump($restClient);

// Instantiate RPC client
$rpcClient = new KyotoClient([
	'url'=>'https://localhost2:1979',
	'protocol'=>'rpc'
]);
var_dump($rpcClient);
