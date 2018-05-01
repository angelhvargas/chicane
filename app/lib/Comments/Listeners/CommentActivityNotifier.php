<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 22/05/2015
 * Time: 12:39
 */

namespace Chicane\Comments\Listeners;


use Chicane\Comments\CommentPostWasPosted;
use Chicane\Comments\Likes\CommentWasLiked;
use Chicane\Eventing\EventListener;

class CommentActivityNotifier extends EventListener
{
    public function whenCommentWasPosted(CommentPostWasPosted $event)
    {

    }

    public function whenCommentWasLiked(CommentWasLiked $event)
    {

    }
}