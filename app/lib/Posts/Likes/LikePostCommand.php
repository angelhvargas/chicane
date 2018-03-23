<?php namespace Sil\Posts\Likes;

class LikePostCommand {
	
	public $userId;
    public $object;

    /**
     * LikePostCommentCommand constructor.
     * @param $userId
     * @param $object
     */
    public function __construct($userId, $object)
    {
        $this->userId = $userId;
        $this->object = $object;
    }
}