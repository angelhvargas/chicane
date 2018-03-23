<?php

namespace Sil\Notifications;

use Illuminate\Support\ServiceProvider;

class NotificationMailServiceProvider extends ServiceProvider {
		
	public function register()
	{
	  	$this->app->bind(
	  		'Sil\Notifications\WeeklyUpdates',
	  		'Sil\Notifications\Mailchimp\WeeklyUpdates'
		);
	}
}
