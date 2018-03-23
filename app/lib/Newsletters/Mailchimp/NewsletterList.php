<?php namespace Sil\Newsletters\Mailchimp;

use \Sil\Newsletters\NewsletterList as NewsletterListInterface;
use Mailchimp;
/**
 * 
 */
class NewsletterList implements NewsletterListInterface {
	/**
	 * @var Mailchimp
	 */
	protected $mailchimp;
	/**
	 * @var array
	 */
	protected $lists = ['test' => '9eebd223b4'];

	/**
	 * @param Mailchimp $mailchimp
	 */
	function __construct(Mailchimp $mailchimp)
	
	{
			$this->mailchimp = $mailchimp;
	}

	/**
	 * @param $listName
	 * @param $email
	 * @return \associative_array
	 */
	 
	 public function subscribeTo($listName, $email)
	 
	 {
	 	return $this->mailchimp->lists->subscribe(
			$this->lists[$listName],
			['email' => $email],
			null, //merge vars,
			'html', //type of email content,
			false, // double check for add the user to this list,
			true //update existing member
		);
	 }
	 
	 /**
	 * @param $list
	 * @param $email
	 * @return mixed
	 */
	 
	 public function unsubscribeFrom($listName, $email)
	 
	 {
	 	return $this->mailchimp->lists->unsubscribe(
			$this->lists[$listName],
			['email' => $email],
			false, // delete member permanently?
			false, // send goodbaye email
			false //send unsuscribe email?
				
		);
	 }
}
