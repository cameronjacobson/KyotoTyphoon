<?php
    
require_once(dirname(__DIR__).'/vendor/autoload.php');

use KyotoTyphoon\KyotoClient;

// Instantiate BINARY client
$binaryClient = new KyotoClient([
	'url'=>'https://localhost2:1979',
	'protocol'=>'binary'
]);
//$binaryClient->replication();
var_dump($binaryClient);

// Instantiate REST client
$restClient = new KyotoClient([
	'url'=>'https://localhost2:1979',
	'protocol'=>'rest'
]);
//$restClient->GET();
var_dump($restClient);

// Instantiate RPC client
$rpcClient = new KyotoClient([
	'url'=>'https://localhost2:1979',
	'protocol'=>'rpc'
]);

$rpcClient->void();
var_dump($rpcClient);
