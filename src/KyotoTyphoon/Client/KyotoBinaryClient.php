<?php

namespace KyotoTyphoon\Client;

use \KyotoTyphoon\Interfaces\KyotoClientInterface;
use \KyotoTyphoon\Transport\KyotoBinaryTransport;

use \KyotoTyphoon\KyotoRequest as Request;
use \KyotoTyphoon\KyotoResponse as Response;

use \KyotoTyphoon\KyotoEvent;

class KyotoBinaryClient implements KyotoClientInterface
{
	public $transport;

	public function __construct(Array $options){
		$this->transport = new KyotoBinaryTransport($options);
	}

    public function replication(Array $params=[],Array $callbacks=[]){
        return $this->send(__FUNCTION__, [
			'params'=>[]
        ],$callbacks);
    }

    public function play_script(Array $params=[],Array $callbacks=[]){
        return $this->send(__FUNCTION__, [
			'params'=>[]
        ],$callbacks);
    }

    public function set_bulk(Array $params=[],Array $callbacks=[]){
        return $this->send(__FUNCTION__, [
			'params'=>[]
        ],$callbacks);
    }

    public function remove_bulk(Array $params=[],Array $callbacks=[]){
        return $this->send(__FUNCTION__, [
			'params'=>[]
        ],$callbacks);
    }

    public function get_bulk(Array $params=[],Array $callbacks=[]){
        return $this->send(__FUNCTION__, [
			'params'=>[]
        ],$callbacks);
    }

    private function send($command,Array $options,Array $callbacks=[]){

        $requestHash = spl_object_hash($request = new Request());
        $responseHash = spl_object_hash($response = new Response());

        $request->command = $command;
        $request->options = $options;

        foreach($callbacks as $event=>$callback){
            if(is_callable($callback)){
                KyotoEvent::once($event,$callback);
            }
        }

        return $this->transport->send($request, $response);
    }

}
