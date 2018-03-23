<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 07/05/2015
 * Time: 15:01
 */

namespace Sil\Eventing;


use Illuminate\Events\Dispatcher;
use Illuminate\Log\Writer;

class EventDispatcher {

    protected $event;

    protected $log;

    /**
     * EventDispatcher constructor.
     * @param $event
     */
    public function __construct(Dispatcher $event, Writer $log)
    {
        $this->event = $event;
        $this->log = $log;
    }


    public function dispatch(array $events)
    {
        foreach ($events as $event) {

            $eventName = $this->getEventName($event);
            $this->event->fire($eventName, $event);
        }

    }

    /**
     * @param $event
     * @return mixed
     */
    protected function getEventName($event)
    {
        return str_replace('\\', '.', get_class($event));
    }

}