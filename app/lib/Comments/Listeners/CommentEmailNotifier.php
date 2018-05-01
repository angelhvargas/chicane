<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 22/05/2015
 * Time: 12:33
 */

namespace Chicane\Comments\Listeners;


use Chicane\Comments\Likes\CommentWasLiked;
use Chicane\Eventing\EventListener;
use Chicane\Comments\CommentPostWasPosted;
use Chicane\Mailers\Notifications\NotifyActionsMailer as Mailer;
use Post;
use Like;

class CommentEmailNotifier extends EventListener
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


    public function whenCommentPostWasPosted(CommentPostWasPosted $event)
    {
        $data = array(
            'emitter' => $event->comment->user->full_name(),
            'receiver' => $event->comment->receiver->full_name(),
            'target' => $event->comment->id,
            'class' => get_class(Post::find($event->comment->post->id)));

        $this->mailer->comment($event->comment->receiver, $data);
    }

    public function whenCommentWasLiked(CommentWasLiked $event)
    {
        $data = array(
            'emitter' => $event->like->user->full_name(),
            'receiver' => $event->like->receiver->full_name(),
            'target' => $event->like->id,
            'class' => get_class(Like::find($event->like->id)));

        $this->mailer->commentLike($event->like->receiver, $data);
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