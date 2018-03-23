<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 25/05/2015
 * Time: 16:52
 */

namespace Sil\Comments\Replies;


/**
 * Class StorePostCommentReply
 * @package Sil\Comments
 */
class StorePostCommentReplyCommand {
    /**
     * @var
     */
    public $userId;
    /**
     * @var
     */
    public $content;
    /**
     * @var
     */
    public $postId;
    /**
     * @var
     */
    public $parentId;


    /**
     * @param $userId
     * @param $content
     * @param $postId
     * @param $parentId
     */
    public function  __construct($userId, $content, $postId, $parentId)
    {
        $this->userId = $userId;
        $this->content = $content;
        $this->postId = $postId;
        $this->parentId = $parentId;
    }
}