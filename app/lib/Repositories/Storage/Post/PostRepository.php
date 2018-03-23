<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 21/08/2015
 * Time: 21:44
 */

namespace Sil\Repositories\Storage\Post;


/**
 * Interface PostRepository
 * @package Sil\Repositories\Post
 */
interface PostRepository
{

    /**
     * @param $authorId
     * @param $title
     * @param $content
     * @param $attachment
     * @param $channelId
     * @param array $tagsId
     * @param array $options
     * @return mixed
     */
    public function create($authorId, $title, $content,$attachment, $channelId, $tagsId = [], $options = []);

    /**
     * @param $postId
     * @return mixed
     */
    public function delete($postId);

    /**
     * @param $postId
     * @param null $title
     * @param null $content
     * @param array $tags
     * @return mixed
     */
    public function update($postId, $title = null, $content = null, $tags = []);

    /**
     * @param $postId
     * @param $content
     * @param $channel
     * @param array $tags
     * @return mixed
     */
    public function share($postId, $content, $channel, $tags = []);
}