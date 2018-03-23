<?php
/**
 * Created by Silooette.
 * Developer: Angel Vargas
 * Date: 15/04/2015
 * Time: 16:51
 */

namespace Sil\Match;


use Illuminate\Support\ServiceProvider as ServiceProvider;

class MatchingServiceProvider extends ServiceProvider{

    public function register()
    {
        $this->app->bind(
          'Sil\Match\MatchingInterface',
            'Sil\Match\Eloquent\UserMatching'
        );

    }

}