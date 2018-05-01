<?php
namespace Chicane\DataTools\Eloquent;
use \Chicane\DataTools\DataMigratorToolInterface;
use Illuminate\Database\Eloquent;
use User;
use Post;
use Topic;
use Activity;
use UserNotification;
use Illuminate\Support\Facades\URL;

class DataMigratorTool implements DataMigratorToolInterface{

    public function notificationsMigrate()
    {
        $actions = Activity::all();
        foreach($actions as $row)
        {
            $emitter  = User::find($row->emitter);
            $receiver = User::find($row->receiver);
            $post = Post::find($row->target);
            switch ($row->type) {
                case '1':

                    if ($post->anonymous == 1){
                        $msg = $emitter->full_name() . " liked ". "Anonymous". "'s post " ;
                    } else {
                        $msg = $emitter->full_name() . " liked " . $receiver->full_name() . "'s post " . _($post->title ? $post->title : strip_tags(substr($post->title, 0, 60)));
                    }
                    $notification = new UserNotification();
                    $notification->withBody("Your post ". _($post->title ? $post->title : strip_tags(substr($post->title, 0 ,60))) ." has been liked by  {{ users }}")
                        ->withSubject($msg)
                        ->withType(1)
                        ->from($emitter)
                        ->to($receiver)
                        ->regarding($post)
                        ->deliver();
                    break;

                case '2':
                    $msg = null;

                    $notification = new UserNotification();
                    $notification->withBody("Your post " .
                        _($post->title ? $post->title : strip_tags(substr($post->title, 0 ,60))) .
                        " has Nudged by {{ users }} ")
                        ->withSubject($msg)
                        ->withType(2)
                        ->from($emitter)
                        ->to($receiver)
                        ->regarding($post)
                        ->deliver();

                    break;
                case '3':
                    if($post->anonymous == 1)
                    {
                        $msg = $emitter->full_name() . " shared Anonymous's post " . $post->title;
                    }
                    else
                    {
                        $msg = $emitter->full_name() . " shared ". $receiver->full_name() . "'s post " . $post->title;
                    }

                    $notification = new UserNotification();
                    $notification->withBody("Your post ". _($post->title ? $post->title : strip_tags(substr($post->title, 0 ,60))) ." has been shared by {{ users }} ")
                        ->withSubject($msg)
                        ->withType(3)
                        ->from($emitter)
                        ->to($receiver)
                        ->regarding($post)
                        ->deliver();
                    break;
                case '4':
                    $topic = Topic::find($row->target);
                    $msg = $emitter->full_name() . " started following ". $receiver->full_name() . "'s channel on " . $topic->name;
                    $link = URL::to('user/'.$receiver->name().'/'.$topic->slug);
                    $notification = new UserNotification();
                    $notification->withSubject($msg)
                        ->withBody("Great! {{ users }} " . " started following ". $receiver->full_name() . "'s channel on " . $topic->name)
                        ->withType(4)
                        ->from($emitter)
                        ->to($receiver)
                        ->regarding($topic)
                        ->deliver();

                case '5':
                    $msg = $emitter->full_name. " started following ". $receiver->full_name();
                    $notification = new UserNotification();
                    $notification->withSubject($msg)
                        ->withBody("Great!  {{ user }} " ." started following you")
                        ->withType(5)
                        ->from($emitter)
                        ->to($receiver)
                        ->regarding($receiver)
                        ->deliver();
                    break;
                case '6':
                    $post = Post::find($row->target) ;
                    if ( $post->anonymous == 1 )
                    {
                        $msg = "{{ users }} " ." commented on Anonymous's post ". $post->title;
                    }else
                    {
                        $msg = "{{ users }} " ." commented on ". $receiver->full_name() ."'s post ". $post->title;
                    }
                    $notification = new UserNotification();
                    $notification->withSubject("Your post " . _($post->title ? $post->title : strip_tags(substr($post->title, 0 ,60))) . " has been commented by {{ users }} ")
                        ->withBody($msg)
                        ->withType(6)
                        ->from($emitter)
                        ->to($receiver)
                        ->regarding($post)
                        ->deliver();
                    break;
                case '7':
                    $post = Post::find($row->target);
                    $msg = "{{ users }} "." also commented on a post ". $post->title();
                    $notification = new UserNotification();
                    $notification
                        ->withSubject("{{ users }} "." also commented on a post ". $post->title())
                        ->withBody($msg)
                        ->to($receiver)
                        ->from($emitter)
                        ->withType(7)
                        ->regarding($post)
                        ->deliver();
                    break;

                //mentioned in comment
                case '8':
                    $post = Post::find($row->target);
                    $msg =  "{{ users }} "." mentioned you in a comment";
                    $notification = new UserNotification();
                    $notification->withSubject($emitter->full_name()." mentioned ".$receiver->full_name()." in a comment")
                        ->withBody($msg)
                        ->to($receiver)
                        ->from($emitter)
                        ->withType(8)
                        ->regarding($post)
                        ->deliver();
                    break;

                //mentioned in post
                case '9':
                    $post = Post::find($row->target);
                    $msg = "{{ users }} "." mentioned you in a post";
                    $notification = new UserNotification();
                    $notification->withSubject($emitter->full_name()." mentioned you in a post")
                        ->withBody($msg)
                        ->withType(9)
                        ->to($receiver)
                        ->from($emitter)
                        ->regarding($post)
                        ->deliver();
                    break;

                default:
                    break;
            }
        }
    }

    public function likesMigrate()
    {

    }

    public function nudgesMigrate()
    {

    }

    public function commentsMigrate()
    {

    }

}