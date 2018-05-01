<?php

namespace Chicane\Notifications;

use Illuminate\Support\ServiceProvider;

class NotificationMailServiceProvider extends ServiceProvider {
		
	public function register()
	{
	  	$this->app->bind(
	  		'Chicane\Notifications\WeeklyUpdates',
	  		'Chicane\Notifications\Mailchimp\WeeklyUpdates'
		);
	}
}
