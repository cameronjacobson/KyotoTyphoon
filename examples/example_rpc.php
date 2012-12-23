<?php

require_once(dirname(__DIR__).'/vendor/autoload.php');

use KyotoTyphoon\KyotoClient;

// Instantiate RPC client
$rpcClient = new KyotoClient([
	'url'=>'http://localhost:1978',
	'protocol'=>'rpc'
]);
echo $rpcClient->set([
	'key'=>'blah',
	'value'=>'value',
	'xt'=>6
]);
echo $rpcClient->get([
	'key'=>'blah'
]);
