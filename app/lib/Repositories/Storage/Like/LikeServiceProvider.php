<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 20/05/2015
 * Time: 11:24
 */

namespace Chicane\Repositories\Storage\Like;



use Illuminate\Support\ServiceProvider;

/**
 * Class LikeServiceProvider
 * @package Chicane\Repositories\Storage\Like
 */
class LikeServiceProvider extends ServiceProvider {

    /**
     *
     */
    public function register()
    {
        $this->app->bind('Chicane\Repositories\Like\Eloquent\EloquentLikeRepository',
            'Chicane\Repositories\Like\LikeRepository');
    }


}