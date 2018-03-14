<?php

namespace Chicane\Events;

class RequestEvent extends \Symfony\Component\EventDispatcher\Event {
    
    protected $request;
$) 
    {
        $this->request = $request;
    }

}