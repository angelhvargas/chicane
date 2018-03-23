<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 07/05/2015
 * Time: 16:44
 */

namespace Sil\Comments;


class ReplyCommentPostWasPosted {

    public $reply;

    /**
     * ReplyWasPosted constructor.
     * @param $reply
     */
    public function __construct($reply)
    {
        $this->reply = $reply;
    }




}