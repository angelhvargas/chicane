<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 14/05/2015
 * Time: 15:13
 */

namespace Sil\Repositories\Storage\Activity;

use Illuminate\Support\ServiceProvider;
class ActivityServiceProvider extends ServiceProvider{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Sil\Repositories\Storage\Activity\ActivityRepository',
                            'Sil\Repositories\Storage\Activity\EloquentActivityRepository');
    }

}