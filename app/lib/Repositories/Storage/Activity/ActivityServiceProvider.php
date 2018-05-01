<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 14/05/2015
 * Time: 15:13
 */

namespace Chicane\Repositories\Storage\Activity;

use Illuminate\Support\ServiceProvider;
class ActivityServiceProvider extends ServiceProvider{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Chicane\Repositories\Storage\Activity\ActivityRepository',
                            'Chicane\Repositories\Storage\Activity\EloquentActivityRepository');
    }

}