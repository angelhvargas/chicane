<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 20/05/2015
 * Time: 17:16
 */

namespace Sil\Comments\Likes;

use Like;

/**
 * Class CommentWasLiked
 * @package Sil\Comments\Likes
 */
class CommentWasLiked {

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