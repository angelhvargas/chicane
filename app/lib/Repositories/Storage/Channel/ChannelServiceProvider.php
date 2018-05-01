<?php


namespace Chicane\Repositories\Channel;

use Illuminate\Support\ServiceProvider;

class ChannelServiceProvider extends ServiceProvider {
	
	public function register()
	{
		$this->app->bind('Chicane\Repositories\Channel\Eloquent\EloquentChannelRepository',
		'Chicane\Repositories\Channel\ChannelRepository');
	}
}