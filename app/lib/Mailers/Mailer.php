<?php namespace Sil\Mailers;
/**
 * Created by Silooette.
 * User: Angel
 * Date: 18/03/2015
 * Time: 10:39
 * Definition: This class manage Notifications queue and dispatch every email to the users after an action
 */
use Illuminate\Support\Facades\Mail;


abstract class Mailer {

    protected $delay = 0;

    public function addToQueue($queue, $user, $subject, $view, $data = [])
    {
        Mail::laterOn($queue, $this->delay, $view, $data, function($message) use ($user, $subject){
            $message->to($user->email)
                ->subject($subject);
        } );
    }
    public function sendTo($user, $subject, $view, $data = [])
    {
        $data['firstname'] = $user->firstname;
        Mail::send($view, $data, function ($message) use ($user, $subject)
        {
                $message->to($user->email)
                    ->subject($subject);
        } );
    }
}