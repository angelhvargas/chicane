<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 07/05/2015
 * Time: 16:41
 */

namespace Sil\Listeners;


use Sil\Comments\Likes\CommentWasLiked;
use Sil\Eventing\EventListener;
use Sil\Comments\CommentPostWasPosted;
use Sil\Mailers\Notifications\NotifyActionsMailer as Mailer;
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