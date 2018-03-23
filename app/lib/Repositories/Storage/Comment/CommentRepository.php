<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 05/05/2015
 * Time: 09:21
 */

namespace Sil\Repositories\Comment;
use Comment;
use User;

interface CommentRepository {

    public function create($userId, $postId, $content, $parent = null);
    public function update($commentId, $message);
    public function delete($comment);
    public function like($userId, $commentId);
    public function nudge($userId, $commentId, $reason);

}