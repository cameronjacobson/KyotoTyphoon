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
			'params'=>[]
        ],$callbacks);
    }

    public function HEAD(Array $params=[],Array $callbacks=[]){
        return $this->send(__FUNCTION__, [
			'params'=>[]
        ],$callbacks);
    }

    public function PUT(Array $params=[],Array $callbacks=[]){
        return $this->send(__FUNCTION__, [
			'params'=>[]
        ],$callbacks);
    }

    public function DELETE(Array $params=[],Array $callbacks=[]){
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
