<?php

require_once(dirname(__DIR__).'/vendor/autoload.php');

use KyotoTyphoon\KyotoClient;

// Instantiate REST client
$restClient = new KyotoClient([
	'url'=>'http://localhost:1978',
	'protocol'=>'rest'
]);
echo 'SETTING blah=value'.PHP_EOL;
var_dump($restClient->PUT([
	'key'=>'blah',
	'value'=>'value',
	'mode'=>'set',
//	'xt'=>6
]));
echo 'GETTING blah'.PHP_EOL;
var_dump($restClient->GET([
	'key'=>'blah'
]));
echo 'DELETING blah'.PHP_EOL;
var_dump($restClient->DELETE([
	'key'=>'blah'
]));
echo 'GETTING blah'.PHP_EOL;
var_dump($restClient->GET([
	'key'=>'blah'
]));
