<?php

namespace KyotoTyphoon\Client;

use \KyotoTyphoon\Interfaces\KyotoClientInterface;
use \KyotoTyphoon\Transport\KyotoRestTransport;

use \KyotoTyphoon\KyotoRequest as Request;
use \KyotoTyphoon\KyotoResponse as Response;

use \KyotoTyphoon\KyotoEvent;

class KyotoRestClient implements KyotoClientInterface
{
	public $transport;

	public function __construct(Array $options){
		$this->transport = new KyotoRestTransport($options);
	}

    public function GET(Array $params=[],Array $callbacks=[]){
        return $this->send(__FUNCTION__, [
			'params'=>$params,
			'callbacks'=>$callbacks
        ],$callbacks);
    }

    public function HEAD(Array $params=[],Array $callbacks=[]){
        return $this->send(__FUNCTION__, [
			'params'=>$params,
			'callbacks'=>$callbacks
        ],$callbacks);
    }

    public function PUT(Array $params=[],Array $callbacks=[]){
        return $this->send(__FUNCTION__, [
			'params'=>$params,
			'callbacks'=>$callbacks
        ],$callbacks);
    }

    public function DELETE(Array $params=[],Array $callbacks=[]){
        return $this->send(__FUNCTION__, [
			'params'=>$params,
			'callbacks'=>$callbacks
        ],$callbacks);
    }

    private function send($command,Array $params){

        $requestHash = spl_object_hash($request = new Request());
        $responseHash = spl_object_hash($response = new Response());

        $request->command = $command;

		foreach($params['params'] as $k=>$v){
			$request->params[$k]=$v;
		}

        foreach($params['callbacks'] as $event=>$callback){
            if(is_callable($callback)){
                KyotoEvent::once($event,$callback);
            }
        }

        return $this->transport->send($request, $response);
    }
}
