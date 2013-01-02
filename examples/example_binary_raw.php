<?php

$client = stream_socket_client('tcp://localhost:1978', $errno, $errstr);
$data = ['zz','a1','b1','c1','d1','e1','f1','g1','h1','i1','j1','k1','l1','m1','n1','o1','p1','q1','r1','s1','t1','u1','v1','w1','x1','y1','z1'];

$start = microtime(true);
echo 'SET: '.set(array_flip($data)).' records'.PHP_EOL;
echo 'FINISHED IN: '.(microtime(true)-$start).' SECONDS'.PHP_EOL;

$start = microtime(true);
list($numrecords,$records) = get($data);
echo 'FINISHED IN: '.(microtime(true)-$start).' SECONDS'.PHP_EOL;
echo 'GOT: '.$numrecords.' RECORDS'.PHP_EOL;
print_r($records);

$start = microtime(true);
echo 'DELETED: '.remove($data).' records'.PHP_EOL;
echo 'FINISHED IN: '.(microtime(true)-$start).' SECONDS'.PHP_EOL;
fclose($client);

function remove($data){
	global $client;

	// REQUEST:  WHAT KEYS DO WE WANT TO REMOVE?
	$request = pack('C',0xB9);            // magic
	$request.= pack('N',0x00);            // bitwise-or flag
	$request.= pack('N',count($data));    // number of records
	fwrite($client,$request);
	foreach($data as $key){
		$record = pack('n',0);            // (iteration) index of the target database.
		$record.= pack('N',strlen($key)); // (iteration) size of the key
		$record.= $key;                   // (iteration) data of the key
		fwrite($client,$record);
	}

	// RESPONSE: HOW MANY DID WE SUCCESSFULLY REMOVE?
	$response = unpack('C/N',fread($client,5));
	return $response[1];
}

function &get($data){
	global $client;

	// WHICH KEYS DO WE WANT?
	$request = pack('C',0xBA);         // magic
	$request.= pack('N',0x00);         // bitwise-or flag
	$request.= pack('N',count($data)); // number of records
	fwrite($client,$request);
	foreach($data as $key){
		$record = pack('n',0);            // dbindex
		$record.= pack('N',strlen($key)); // key size
		$record.= $key;                   // key
		fwrite($client,$record);
	}

	// RETRIEVE THE DATA
	$response = unpack('C/N',fread($client,5));
	$data = array();
	for($x=0,$y=$response[1];$x<$y;$x++){
		$db = unpack('n',fread($client,2));     // dbindex
		$ksize = unpack('N',fread($client,4));  // key size
		$vsize = unpack('N',fread($client,4));  // value size
		$xt = unpack('N/N',fread($client,8));   // xt (expiration)
		$key = fread($client,$ksize[1]);        // key
		$val = fread($client,$vsize[1]);        // value
		$data[$key] = $val;
	}
	return array($response[1],$data);
}

function set($data){
	global $client;

	// REQUEST:  WHAT KEY/VALUE PAIRS DO WE WANT TO SET?
	$request = pack('C',0xB8);         // magic
	$request.= pack('N',0x00);         // bitwise-or flag
	$request.= pack('N',count($data)); // number of records
	fwrite($client,$request);
	foreach($data as $key=>$val){
		$record = pack('n',0);            // index of the target database.
		$record.= pack('N',strlen($key)); // key size
		$record.= pack('N',strlen($val)); // value size
		$record.= pack('NN',0,5);         // xt (expiration)
		$record.= $key;                   // key
		$record.= $val;                   // value
		fwrite($client,$record);
	}

	// RESPONSE: HOW MANY DID WE SUCCESSFULLY SET?
	$response = unpack('C/N',fread($client,5));
	return $response[1];
}

