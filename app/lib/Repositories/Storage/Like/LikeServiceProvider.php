<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 20/05/2015
 * Time: 11:24
 */

namespace Sil\Repositories\Storage\Like;



use Illuminate\Support\ServiceProvider;

/**
 * Class LikeServiceProvider
 * @package Sil\Repositories\Storage\Like
 */
class LikeServiceProvider extends ServiceProvider {

    /**
     *
     */
    public function register()
    {
        $this->app->bind('Sil\Repositories\Like\Eloquent\EloquentLikeRepository',
            'Sil\Repositories\Like\LikeRepository');
    }


}