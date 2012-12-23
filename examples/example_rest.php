<?php

require_once(dirname(__DIR__).'/vendor/autoload.php');

use KyotoTyphoon\KyotoClient;

// Instantiate REST client
$restClient = new KyotoClient([
	'url'=>'http://localhost:1978',
	'protocol'=>'rest'
]);

$start = microtime(true);

echo PHP_EOL.'-SETTING blah=value'.PHP_EOL;
echo $restClient->PUT([
	'key'=>'blah',
	'value'=>'value',
	'mode'=>'set',
//	'xt'=>6
]);
echo PHP_EOL.'-GETTING blah'.PHP_EOL;
echo $restClient->GET([
	'key'=>'blah'
]);
echo PHP_EOL.PHP_EOL.'-DELETING blah'.PHP_EOL;
echo $restClient->DELETE([
	'key'=>'blah'
]);
echo PHP_EOL.'-GETTING blah'.PHP_EOL;
echo $restClient->GET([
	'key'=>'blah'
]);

echo 'FINISHED IN: '.(microtime(true)-$start).' SECONDS'.PHP_EOL;
