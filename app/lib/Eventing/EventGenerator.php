<?php

namespace Chicane\Eventing;


/**
 * Class EventGenerator
 * @package Chicane\Eventing
 */
trait EventGenerator {

    /**
     * @var
     */
    protected $pendingEvents;


    /**
     * @param $event
     */
    public function raise($event)
    {
        $this->pendingEvents[] = $event;
    }

    /**
     * @return mixed
     */
    public function releaseEvents()
    {
        $events = $this->pendingEvents;
        $this->pendingEvents = [];
        return $events;
    }



}