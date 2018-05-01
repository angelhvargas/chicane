<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 22/05/2015
 * Time: 12:33
 */

namespace Chicane\Posts\Listeners;


use Chicane\Posts\Likes\PostWasLiked;
use Chicane\Eventing\EventListener;
use Chicane\Comments\LikePostWasPosted;
use Chicane\Mailers\Notifications\NotifyActionsMailer as Mailer;
use Like;
use Chicane\Posts\Nudges\PostWasNudged;

class PostEmailNotifier extends EventListener
{
    protected $mailer;

    /**
     * EmailNotifier constructor.
     * @param $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }
	
    public function whenPostWasLiked(PostWasLiked $event)
    {
        $data = array(
            'emitter' => $event->like->user->full_name(),
            'receiver' => $event->like->receiver->full_name(),
            'target' => $event->like->id,
            'class' => get_class(Like::find($event->like->id)));

        $this->mailer->postLike($event->like->receiver, $data);
    }

    public function whenPostWasNudged(PostWasNudged $event)
    {
        $data = array(
            'emitter' => $event->nudge->user->full_name(),
            'receiver' => $event->nudge->receiver->full_name(),
            'target' => $event->nudge->id,
            'class' => get_class(Nudge::find($event->like->id)));

        $this->mailer->nudge($event->nudge->receiver, $data);
    }

    public function whenCommentWasNudged(CommentWasNudged $event)
    {
        //todo
    }

    public function whenCommentWasReplied(CommentWasReplied $event)
    {
        //todo
    }
}