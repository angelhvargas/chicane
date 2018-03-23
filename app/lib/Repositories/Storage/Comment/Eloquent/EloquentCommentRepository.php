<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 05/05/2015
 * Time: 09:18
 */

namespace Sil\Repositories\Comment\Eloquent;

use User;
use Comment;
use Post;
use Sil\Repositories\Comment\CommentRepository;
use Sil\Comments\CommentPostWasPosted;
use Sil\Comments\Replies\CommentPostReplyWasPosted;


/**
 * Class EloquentCommentRepository
 * @package Sil\Repositories\Comment\Eloquent
 */
class EloquentCommentRepository implements CommentRepository {


    /**
     * @param $userId
     * @param $postId
     * @param $content
     * @param null $parent
     * @param null $anonymous
     * @return Comment|string
     */
    public function create($userId, $postId, $content, $parent = null, $anonymous = null)
    {
        if(is_null($parent))
        {

            return $this->setNewComment($userId, $postId, $content, $anonymous);

        }
        else
        {

            return $this->setNewReply($userId, $postId, $content, $parent, $anonymous);

        }
    }


    /**
     * @param $senderId
     * @param $postId
     * @param $content
     * @param null $anonymous
     * @return Comment|string
     */
    public function setNewComment($senderId, $postId, $content, $anonymous = null)
    {
        try
        {

            $post = Post::find($postId);
            $user = User::find($senderId);
            $comment = new Comment();
            $comment->setRegarding($post);
            $comment->setTo($post->user);
            $comment->setFrom($user);
            $comment->setContent($content);
            if(!is_null($anonymous))
                $comment->setAnonymous();
            $comment->set();

        }
        catch(Exception $e)
        {
            return 'an error occurred during the write operation: '. $e;
        }

        $comment->raise(new CommentPostWasPosted($comment));

        return $comment;

    }

    /**
     * @param $userId
     * @param $postId
     * @param $content
     * @param $parent
     * @param null $anonymous
     * @return string
     */
    public function setNewReply($userId, $postId, $content, $parent, $anonymous = null)
    {
        try
        {

            $post = Post::findOrFail($postId);
            $user = User::findOrFail($userId);
            $comment = Comment::findOrFail($parent);
            $reply = new Comment();
            $reply->setRegarding($post)
                ->setTo($post->user)
                ->setFrom($user)
                ->setParent($comment)
                ->setContent($content)
                ->set();
            if(!is_null($anonymous))
            {
                $comment->setAnonymous();
                $reply->set();
            }


        }
        catch(Exception $e)
        {
            return 'an error occurred during the write operation: '. $e;
        }

        $reply->raise(new CommentPostReplyWasPosted($reply));

        return $reply;
    }


    /**
     * @param $commentId
     * @param $message
     * @return mixed
     */
    public function update($commentId, $message)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->content = $message;
        $comment->save();
        return $comment;

    }


    /**
     * @param $commentId
     * @return array|string
     */
    public function delete($commentId)
    {

        $response = [
                'id' => $commentId,
                'type' => 'parent',
                'repliesIds' => [],
                'post_id' => null,
                'comment_count' => null,
                'status' => 0
        ];


        try
        {
            $comment = Comment::findOrFail($commentId);
            $children = $comment->replies;

            if( ( !is_null($comment) || !is_null($children) ) && $comment->commentable_type == 'Post')
            {
                $post = Post::findOrFail($comment->commentable_id);
                $response['post_id'] = $post->id;
            }


            if ( !is_null($children) )
            {
                foreach ( $children as $child ) {
                    $response['repliesIds'][] = $child->id;

                    $this->_deleteRelationships($child);

                    $response['status'] = $child->delete();

                }

                $this->_deleteRelationships($comment);

                $response['type'] = $comment->parent_id ? 'reply' : 'parent';
                $response['status'] = $comment->delete();
            }else
            {

                $this->_deleteRelationships($comment);

                $response['status'] = $comment->delete();
            }

            $response['comment_count'] = $post->comments->count();


        }
        catch(\Exception $e)
        {
            return 'something bad just happened'. $e;
        }

        return $response;

    }

    /**
     * @param $userId
     * @param $commentId
     */
    public function like($userId, $commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->setLiked();


    }

    /**
     * @param $userId
     * @param $commentId
     * @param $reason
     */
    public function nudge($userId, $commentId, $reason)
    {
        $comment = Comment::find($commentId);
        $comment->setNudged();
    }

    /**
     * @param $object
     * @return bool
     */
    protected function _deleteRelationships($object)
    {
        $likes = $object->likes;
        $nudges = $object->nudges;

        foreach($likes as $like)
        {
            $this->_detachLike($like);
        }

        foreach($nudges as $nudge)
        {
            $this->_detachNudge($nudge);
        }
        return true;

    }

    /**
     * @param $like
     * @return mixed
     */
    private function _detachLike($like)
    {
        return $like->delete();
    }

    /**
     * @param $nudge
     * @return mixed
     */
    private function _detachNudge($nudge)
    {
        return $nudge->delete();
    }



}