<?php
namespace Chicane\DataTools;

use \Illuminate\Support\ServiceProvider;

class DataMigratorToolServiceProvider extends ServiceProvider{

    public function register(){

        $this->app->bind(
          'Chicane\DataTools\DataMigratorToolInterface',
            'Chicane\DataTools\Eloquent\DataMigratorTool'
        );
    }
}