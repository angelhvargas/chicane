<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 07/05/2015
 * Time: 16:41
 */

namespace Chicane\Listeners;


use Chicane\Comments\Likes\CommentWasLiked;
use Chicane\Eventing\EventListener;
use Chicane\Comments\CommentPostWasPosted;
use Chicane\Mailers\Notifications\NotifyActionsMailer as Mailer;
use Post;
use Like;

class EmailNotifier extends EventListener{

    protected $mailer;

    /**
     * EmailNotifier constructor.
     * @param $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

}