<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 22/10/2015
 * Time: 23:04
 */

namespace Chicane\Services\ServiceProviders;


use Illuminate\Support\ServiceProvider;

class GlideServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
         $this->app->singleton('League\Glide\Server', function($app){
            $filesystem = $app->make('Illuminate\Contracts\Filesystem\Filesystem');
            return \League\Glide\ServerFactory::create([
               'source' => $filesystem->getDriver(),
                'cache' => $filesystem->getDriver(),
                'source_path_prefix' => 'images',
                'cache_path_prefix' => 'images/.cache',
            ]);
        });
    }


}