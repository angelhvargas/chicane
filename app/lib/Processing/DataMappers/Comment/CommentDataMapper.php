<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 15/05/2015
 * Time: 18:17
 */

namespace Sil\Processing\DataMappers\Comment;

use Sil\Processing\DataMappers\DataMapperInterface;
use Post;

/**
 * Class CommentDataMapper
 * @package Sil\Processing\DataMappers\Comment
 */
class CommentDataMapper implements DataMapperInterface{

    /**
     * @var
     */
    protected $object;

    /**
     * @var
     */
    protected $response;


    /**
     * @param $comment
     * @return $this
     */
    public function process($comment)
    {
        $this->object = $comment;
        $this->response = $this->object;
        return $this;
    }

    /**
     * @return string
     */
    public function toAjax()
    {
        $comment_count = null;

        if( $this->object->isAnonymous() )
        {
            $ownerUrl = $this->object->user->url();
            $ownerName = $this->object->user->penname();
            $ownerPicture = $this->object->user->profile_picture(1);
        }
        else
        {
            $ownerName = $this->object->user->full_name();
            $ownerUrl = $this->object->user->url();
            $ownerPicture = $this->object->user->profile_picture();
        }


        if($this->object->commentable_type == 'Post')
        {
            $post = Post::find($this->object->commentable_id);
            $comment_count = $post->comments->count();
        }

        $userId = $this->object->user->id;
        $likes = $this->object->likes()->count();
        $replies = $this->object->replies()->count();
        $nudges = $this->object->nudges()->count();

        return array
                    (   'post_id' => $this->object->commentable_id,
                        'comment_id' => $this->object->id,
                        'user_url' => $ownerUrl,
                        'user_picture' => asset($ownerPicture),
                        'user_name' => $ownerName,
                        'content' => $this->object->content,
                        'parent_id' => $this->object->parent_id,
                        'timestamp' =>$this->object->created_at,
                        'likes' => $likes,
                        'nudges' => $nudges,
                        'replies' => $replies,
                        'comment_count' => $comment_count,
                        'user_id' => $userId
                    );

    }

    /**
     * @return $this
     */
    public function toBlade()
    {
        return $this;
    }

    /**
     * @return $this
     */
    public function toXML()
    {
        return $this;
    }




}