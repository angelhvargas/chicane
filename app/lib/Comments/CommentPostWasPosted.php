<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 07/05/2015
 * Time: 15:33
 */

namespace Sil\Comments;
use Comment;

class CommentPostWasPosted {

    public $comment;

    /**
     * CommentWasPosted constructor.
     * @param $comment
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }


}