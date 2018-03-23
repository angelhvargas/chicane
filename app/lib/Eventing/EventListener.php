<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 07/05/2015
 * Time: 16:38
 */

namespace Sil\Eventing;
use ReflectionClass;

class EventListener {


    public function handle($event)
    {
        $eventName = $this->getEventName($event);

        if ($this->listenerIsRegistered($eventName))
        {
            return call_user_func([$this, "when". $eventName], $event );
        }


    }

    /**
     * @param $event
     */
    protected function getEventName($event)
    {
        return  (new ReflectionClass($event))->getShortName();
    }

    /**
     * @param $method
     * @return bool
     */
    protected function listenerIsRegistered($eventName)
    {
        $method = "when{$eventName}";
        return method_exists($this, $method);
    }

}