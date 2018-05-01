<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 25/05/2015
 * Time: 17:23
 */

namespace Chicane\Comments\Replies\Anonymous;


/**
 * Class AnonymousCommentPostReplyWasPosted
 * @package Chicane\Comments\Replies\Anonymous
 */
class AnonymousCommentPostReplyWasPosted
{
    /**
     * @var
     */
    public $reply;


    /**
     * @param $reply
     */
    public function __construct($reply)
    {
        $this->reply = $reply;
    }
}