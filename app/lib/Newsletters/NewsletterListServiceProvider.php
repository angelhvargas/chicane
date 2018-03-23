<?php

namespace Sil\Newsletters;

use Illuminate\Support\ServiceProvider;

class NewsletterListServiceProvider extends ServiceProvider{
	
	
	public function register()
	{
		$this->app->bind(
			'Sil\Newsletters\NewsletterList',
			'Sil\Newsletters\MailChimp\NewsletterList'
		);
	}
}
