<?php

namespace KyotoTyphoon\Client;

use \KyotoTyphoon\Interfaces\KyotoClientInterface;
use \KyotoTyphoon\Transport\KyotoRpcTransport;

use \KyotoTyphoon\KyotoRequest as Request;
use \KyotoTyphoon\KyotoResponse as Response;

use \KyotoTyphoon\KyotoEvent;

class KyotoRpcClient implements KyotoClientInterface
{
	private $defaultEncoding = 'B';
	private $defaultContentType = 'text/tab-separated-values';
	private $validContentTypes = ['text/tab-separated-values','application/x-www-form-urlencoded','query-string'];
	private $validEncodings = ['base64'=>'B', 'quoted-printable'=>'Q', 'url-encoding'=>'U'];
	public $transport;

	public function __construct(Array $options){
		$this->transport = new KyotoRpcTransport($options);
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

	public function void(Array $params=[],Array $callbacks=[]){
		return $this->send(__FUNCTION__, [
			'params'=>$params
		],$callbacks);
	}

	public function _echo(Array $params=[],Array $callbacks=[]){
		return $this->send('echo', [
			'params'=>$params
		],$callbacks);
	}

	public function report(Array $params=[],Array $callbacks=[]){
		return $this->send(__FUNCTION__, [
			'params'=>$params
		],$callbacks);
	}

	public function play_script(Array $params=[],Array $callbacks=[]){
		return $this->send(__FUNCTION__, [
			'params'=>$params
		],$callbacks);
	}

	public function tune_replication(Array $params=[],Array $callbacks=[]){
		return $this->send(__FUNCTION__, [
			'params'=>$params
		],$callbacks);
	}

	public function status(Array $params=[],Array $callbacks=[]){
		return $this->send(__FUNCTION__, [
			'params'=>$params
		],$callbacks);
	}

	public function clear(Array $params=[],Array $callbacks=[]){
		return $this->send(__FUNCTION__, [
			'params'=>$params
		],$callbacks);
	}

	public function synchronize(Array $params=[],Array $callbacks=[]){
		return $this->send(__FUNCTION__, [
			'params'=>$params
		],$callbacks);
	}

	public function set(Array $params=[],Array $callbacks=[]){
		return $this->send(__FUNCTION__, [
			'params'=>$params
		],$callbacks);
	}

	public function add(Array $params=[],Array $callbacks=[]){
		return $this->send(__FUNCTION__, [
			'params'=>$params
		],$callbacks);
	}

	public function replace(Array $params=[],Array $callbacks=[]){
		return $this->send(__FUNCTION__, [
			'params'=>$params
		],$callbacks);
	}

	public function append(Array $params=[],Array $callbacks=[]){
		return $this->send(__FUNCTION__, [
			'params'=>$params
		],$callbacks);
	}

	public function increment(Array $params=[],Array $callbacks=[]){
		return $this->send(__FUNCTION__, [
			'params'=>$params
		],$callbacks);
	}

	public function increment_double(Array $params=[],Array $callbacks=[]){
		return $this->send(__FUNCTION__, [
			'params'=>$params
		],$callbacks);
	}

	public function cas(Array $params=[],Array $callbacks=[]){
		return $this->send(__FUNCTION__, [
			'params'=>$params
		],$callbacks);
	}

	public function remove(Array $params=[],Array $callbacks=[]){
		return $this->send(__FUNCTION__, [
			'params'=>$params
		],$callbacks);
	}

	public function get(Array $params=[],Array $callbacks=[]){
		return $this->send(__FUNCTION__, [
			'params'=>$params
		],$callbacks);
	}

	public function check(Array $params=[],Array $callbacks=[]){
		return $this->send(__FUNCTION__, [
			'params'=>$params
		],$callbacks);
	}

	public function seize(Array $params=[],Array $callbacks=[]){
		return $this->send(__FUNCTION__, [
			'params'=>$params
		],$callbacks);
	}

	public function set_bulk(Array $params=[],Array $callbacks=[]){
		return $this->send(__FUNCTION__, [
			'params'=>$params
		],$callbacks);
	}

	public function remove_bulk(Array $params=[],Array $callbacks=[]){
		return $this->send(__FUNCTION__, [
			'params'=>$params
		],$callbacks);
	}

	public function get_bulk(Array $params=[],Array $callbacks=[]){
		return $this->send(__FUNCTION__, [
			'params'=>$params
		],$callbacks);
	}

	public function vacuum(Array $params=[],Array $callbacks=[]){
		return $this->send(__FUNCTION__, [
			'params'=>$params
		],$callbacks);
	}

	public function match_prefix(Array $params=[],Array $callbacks=[]){
		return $this->send(__FUNCTION__, [
			'params'=>$params
		],$callbacks);
	}

	public function match_regex(Array $params=[],Array $callbacks=[]){
		return $this->send(__FUNCTION__, [
			'params'=>$params
		],$callbacks);
	}

	public function match_similar(Array $params=[],Array $callbacks=[]){
		return $this->send(__FUNCTION__, [
			'params'=>$params
		],$callbacks);
	}

	public function cur_jump(Array $params=[],Array $callbacks=[]){
		return $this->send(__FUNCTION__, [
			'params'=>$params
		],$callbacks);
	}

	public function cur_jump_back(Array $params=[],Array $callbacks=[]){
		return $this->send(__FUNCTION__, [
			'params'=>$params
		],$callbacks);
	}

	public function cur_step(Array $params=[],Array $callbacks=[]){
		return $this->send(__FUNCTION__, [
			'params'=>$params
		],$callbacks);
	}

	public function cur_step_back(Array $params=[],Array $callbacks=[]){
		return $this->send(__FUNCTION__, [
			'params'=>$params
		],$callbacks);
	}

	public function cur_set_value(Array $params=[],Array $callbacks=[]){
		return $this->send(__FUNCTION__, [
			'params'=>$params
		],$callbacks);
	}

	public function cur_remove(Array $params=[],Array $callbacks=[]){
		return $this->send(__FUNCTION__, [
			'params'=>$params
		],$callbacks);
	}

	public function cur_get_key(Array $params=[],Array $callbacks=[]){
		return $this->send(__FUNCTION__, [
			'params'=>$params
		],$callbacks);
	}

	public function cur_get_value(Array $params=[],Array $callbacks=[]){
		return $this->send(__FUNCTION__, [
			'params'=>$params
		],$callbacks);
	}

	public function cur_get(Array $params=[],Array $callbacks=[]){
		return $this->send(__FUNCTION__, [
			'params'=>$params
		],$callbacks);
	}

	public function cur_seize(Array $params=[],Array $callbacks=[]){
		return $this->send(__FUNCTION__, [
			'params'=>$params
		],$callbacks);
	}

	public function cur_delete(Array $params=[],Array $callbacks=[]){
		return $this->send(__FUNCTION__, [
			'params'=>$params
		],$callbacks);
	}

	private function send($command,Array $params,Array $callbacks=[]){

		$requestHash = spl_object_hash($request = new Request());
		$responseHash = spl_object_hash($response = new Response());

		$request->command = $command;
		$request->params = $params['params'];

		foreach($callbacks as $event=>$callback){
			if(is_callable($callback)){
				KyotoEvent::once($event,$callback);
			}
		}

		return $this->transport->send($request, $response);
	}
}
