<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 07/05/2015
 * Time: 12:16
 */

namespace Sil\Comments;


class StorePostCommentCommand {

    public $userId;
    public $content;
    public $postId;

    /**
     * StorePostCommentCommand constructor.
     * @param $userId
     * @param $content
     * @param $postId
     */
    public function  __construct($userId, $content, $postId)
    {
        $this->userId = $userId;
        $this->content = $content;
        $this->postId = $postId;
    }


}