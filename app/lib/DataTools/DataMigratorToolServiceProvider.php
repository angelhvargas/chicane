<?php
namespace Sil\DataTools;

use \Illuminate\Support\ServiceProvider;

class DataMigratorToolServiceProvider extends ServiceProvider{

    public function register(){

        $this->app->bind(
          'Sil\DataTools\DataMigratorToolInterface',
            'Sil\DataTools\Eloquent\DataMigratorTool'
        );
    }
}