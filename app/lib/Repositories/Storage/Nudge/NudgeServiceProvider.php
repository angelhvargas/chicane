<?php

namespace Chicane\Repositories\Storage\Nudge;


use Illuminate\Support\ServiceProvider;

class NudgeServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Chicane\Repositories\Storage\Nudge\NudgeRepository',
            'Chicane\Repositories\Storage\Nudge\Eloquent\EloquentNudgeRepository');
    }

}