<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 22/05/2015
 * Time: 12:39
 */

namespace Sil\Comments\Listeners;


use Sil\Comments\CommentPostWasPosted;
use Sil\Comments\Likes\CommentWasLiked;
use Sil\Eventing\EventListener;

class CommentActivityNotifier extends EventListener
{
    public function whenCommentWasPosted(CommentPostWasPosted $event)
    {

    }

    public function whenCommentWasLiked(CommentWasLiked $event)
    {

    }
}