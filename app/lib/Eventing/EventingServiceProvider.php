<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 07/05/2015
 * Time: 17:13
 */

namespace Sil\Eventing;

use Illuminate\Support\ServiceProvider;

class EventingServiceProvider extends ServiceProvider{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $listeners = $this->app['config']->get('silooette.listeners');

        foreach($listeners as $listener)
        {
            $this->app['events']->listen('Sil.*', $listener);
        }
    }

}