<?php namespace Chicane\Posts\Likes;

/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 20/05/2015
 * Time: 17:16
 */
 
use Like;

class PostWasLiked {
	 
	 /**
     * @var Like
     */
    public $like;

    /**
     * @param Like $like
     */
    public function __construct(Like $like)
    {
        $this->like = $like;
    }
	
}