<?php namespace Chicane\Mailers\Notifications;
/**
 * Created by Silooette.
 * User: Angel
 * Date: 18/03/2015
 * Time: 10:39
 * Definition: This class manage Notifications queue and dispatch every email to the users after an action
 */
use Chicane\Mailers\Mailer as Mailer;
use User;

/**
 * Class NotifyActionsMailer
 * @package Chicane\Mailers\Notifications
 */
class NotifyActionsMailer extends Mailer{

    /**
     * @param User $user
     * @param $data
     * @return null|void
     */
    public function follower(User $user, $data)
    {
        $view = 'emails.notifications.follower';
        $subject = $data['emitter']. " started following you at silOOette";
        if($user->notificationSetting->mail_follower == 1)
            return $this->sendTo($user, $subject, $view, $data);
        else
            return null;

    }

    /**
     * @param User $user
     * @param $data
     * @return null|void
     */
    public function like(User $user, $data)
    {
        $view = 'emails.notifications.summary';
        $subject = $data['emitter']. " has liked your post on silOOette";
        if($user->notificationSetting->mail_like == 1)
            return $this->sendTo($user, $subject, $view, $data);
        else
            return null;
    }

    /**
     * @param User $user
     * @param $data
     * @return null|void
     */
    public function commentLike(User $user, $data)
    {
        $view = 'emails.notifications.comment.like';
        $subject = $data['emitter']. " has liked your comment on silOOette";
        if($user->notificationSetting->mail_like == 1)
            return $this->sendTo($user, $subject, $view, $data);
        else
            return null;
    }

    /**
     * @param User $user
     * @param $data
     * @return null|void
     */
    public function comment(User $user, $data)
    {
        $view = 'emails.notifications.comment';
        $subject = $data['emitter'] ." has commented on your post on silOOette";
        if($user->notificationSetting->mail_comment == 1)
            return $this->sendTo($user, $subject, $view, $data);
        else
            return null;
    }

    /**
     * @param User $user
     * @param $data
     * @return null|void
     */
    public function mention(User $user, $data)
    {
        $view = 'emails.notifications.mention';
        $subject = $data['emitter'] . " has mentioned you on silOOette";
        if($user->notificationSetting->mail_mention == 1)
            return $this->sendTo($user, $subject, $view, $data);
        else
            return null;
    }

    /**
     * @param User $user
     * @param $data
     * @return null|void
     */
    public function nudge(User $user, $data)
    {
        $view = 'emails.notifications.nudge';
        $subject = "A user has nudged your post on silOOette";
        if($user->notificationSetting->mail_nudge == 1)
            return $this->sendTo($user, $subject, $view, $data);
        else
            return null;
    }

    /**
     * @param User $user
     * @param $data
     * @return null|void
     */
    public function repost(User $user, $data)
    {
        $view = 'emails.notifications.repost';
        $subject = "Great! Someone has reshared your post on silOOette";
        if($user->notificationSetting->mail_repost == 1)
            return $this->sendTo($user, $subject, $view, $data);
       else
           return null;
    }

}