<?php namespace Sil\Handlers;

use Sil\Mailers\Notifications\NotifyActionsMailer as NotifyActionsMailer;
use Activity;
use Nudge;
use Illuminate\Support\Facades\Auth;

class PostEventHandler {
    /**
     * @var NotifyActionsMailer
     */
    protected $mailer;
    /**
     * @var Activity
     */
    protected $activity;

    /**
     * Dependencies:
     * @param NotifyActionsMailer $mailer
     * @param Activity $activity
     */
    public function __construct( NotifyActionsMailer $mailer, Activity $activity )
    {
        $this->mailer = $mailer;
        $this->activity = $activity;
    }

    /**
     * Nudge a post actions sequence
     * @param $events
     */
    public function onNudge( Nudge $nudge, $data )
    {
        $this->mailer->nudge( $nudge->user, $data );
        $nudge->user->newActivity()
            ->setFrom( Auth::user() )
            ->setRegarding($nudge)
            ->setType(2)
            ->setReason($nudge->reason)
            ->setSubject($nudge->hasValidObject())
            ->set();
    }

    /**
     * Like a post actions sequence
     * @param Like $like
     * @param $data
     */
    public function onLike(Like $like, $data)
    {
        $this->mailer->like( $like->user, $data);
    }

    public function onComment()
    {
        //todo
    }

    public function onShare()
    {
        //todo
    }

    public function subscribe($events)
    {
        $events->listen('post.nudge', 'Sil\Handlers\PostEventHandler@onNudge');
        $events->listen('post.like', 'Sil\Handlers\PostEventHandler@onLike');

    }
}