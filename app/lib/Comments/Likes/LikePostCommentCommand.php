<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 11/05/2015
 * Time: 16:40
 */

namespace Chicane\Comments\Likes;


class LikePostCommentCommand {

    public $userId;
    public $object;

    /**
     * LikePostCommentCommand constructor.
     * @param $userId
     * @param $commentId
     */
    public function __construct($userId, $object)
    {
        $this->userId = $userId;
        $this->object = $object;
    }


}