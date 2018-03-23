<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 06/05/2015
 * Time: 08:34
 */

namespace Sil\Repositories\Comment;

use Illuminate\Support\ServiceProvider;
class CommentServiceProvider extends ServiceProvider {
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Sil\Repositories\Comment\CommentRepository',
                'Sil\Repositories\Comment\EloquentCommentRepository');
    }


}