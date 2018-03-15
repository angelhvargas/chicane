<?php

namespace Chicane\Events;

class RequestEvent extends \Symfony\Component\EventDispatcher\Event {
    
    protected $request;

    public function setRequest($request) 
    {
        $this->request = $request;
    }

    public function getRequest()
    {
        return $this->request;
    }

}