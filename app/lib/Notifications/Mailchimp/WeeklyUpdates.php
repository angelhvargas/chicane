<?php namespace Sil\Notifications\Mailchimp;

use Sil\Notifications\WeeklyUpdates as WeeklyUpdatesInterface;
use Mailchimp;
use models\User;
use models\Post;

class WeeklyUpdates implements  WeeklyUpdatesInterface{
	
	/**
	 * List ID
	 */
	
	const LIKED_SUBSCRIBERS_ID = '9eebd223b4';
	
	/**
	 * @var
	 */	
	protected $mailchimp;
	
	/**
	 * @param Mailchimp $Mailchimp
	 */
	function __construct(Mailchimp $mailchimp)
	{
		$this->mailchimp = $mailchimp;
	}
	
	/**
	 * Notify user regarding a new like
	 * @param $title
	 * @param $body
	 * @param $object
	 * @return mixed
	 * 
	 */
	 
	 public function notify($title, $body, $object)
	 {
	 	$options = array(
	 		'list_id' => self::LIKED_SUBSCRIBERS_ID,
	 		'subject' => 'This is a test',
	 		'from_name' => 'SilOOette',
	 		'from_email' => 'angel@silooette.com',
	 		'to_name'	=> 'test-silooette'
	 	);
		
		$content = array(
			'html' => $body,
			'text' => strip_tags($body)
		);
		
	 	$this->mailchimp->campaigns->create('regular', $options, $content);
		
		$this->mailchimp->campaigns->send($campaigns['id']);
	 }
}
