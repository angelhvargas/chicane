<?php

namespace Chicane\Newsletters;

use Illuminate\Support\ServiceProvider;

class NewsletterListServiceProvider extends ServiceProvider{
	
	
	public function register()
	{
		$this->app->bind(
			'Chicane\Newsletters\NewsletterList',
			'Chicane\Newsletters\MailChimp\NewsletterList'
		);
	}
}
