<?php


namespace Sil\Repositories\Channel;

use Illuminate\Support\ServiceProvider;

class ChannelServiceProvider extends ServiceProvider {
	
	public function register()
	{
		$this->app->bind('Sil\Repositories\Channel\Eloquent\EloquentChannelRepository',
		'Sil\Repositories\Channel\ChannelRepository');
	}
}