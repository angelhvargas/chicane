<?php namespace Sil\Eventing;

use Illuminate\Foundation\Application;

/**
 * Class EventListenerTranslator
 * @package Sil\Eventing
 */
class EventListenerTranslator {

	/**
	 * @var
     */
	protected $listener;
	/**
	 * @var Application
     */
	protected $app;
	/**
	 * @var
     */
	protected $object;
	/**
	 * @var
     */
	protected $parent;

	/**
	 * @param Application $app
     */
	public function __construct(Application $app)
	{
		$this->app = $app;
	}

	/**
	 * @param $target
	 * @param $action
	 * @param $object
	 * @return mixed
     */
	public function toEventListener($target, $action, $object)
	{
		$this->parent = $target;
		return $this->setListener( implode( [ get_class( $target ), $action]), $object )->createListener();
		
	}

	/**
	 * @param $listener
	 * @param $object
	 * @return $this
     */
	private function setListener($listener, $object)
	{
		
		$this->object = $object;
		
		$this->listener = $listener;
		
		return $this;
	}

	/**
	 * @return mixed
     */
	private function createListener()
	{
		return $this->app->make('\\Sil\\'.get_class($this->parent).'s\\'.get_class($this->object).'s\\'.$this->listener, [strtolower(get_class($this->object)) => $this->object]);
	}
	
}