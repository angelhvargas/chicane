<?php

namespace Sil\Repositories\Storage\Nudge;


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
        $this->app->bind('Sil\Repositories\Storage\Nudge\NudgeRepository',
            'Sil\Repositories\Storage\Nudge\Eloquent\EloquentNudgeRepository');
    }

}