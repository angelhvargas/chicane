<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 25/05/2015
 * Time: 17:15
 */

namespace Sil\Comments\Replies\Anonymous;


/**
 * Class AnonymousPostCommentReplyCommand
 * @package Sil\Comments\Replies\Anonymous
 */
class AnonymousPostCommentReplyCommand
{
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