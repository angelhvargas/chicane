<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 21/08/2015
 * Time: 21:46
 */

namespace Chicane\Repositories\Storage\Post\Eloquent;

use Chicane\Repositories\Storage\Post\PostRepository;
use Topic;
use Post;

class EloquentPostRepository implements PostRepository
{
    protected $contentProcessor;

    public function __construct($processor)
    {
        $this->contentProcessor = $processor;
    }

    public function create($authorId, $title, $content, $attachment,  $channelId, $tagIds = [], $options = [])
    {
        //title
        //content
        //   check if exist images or mentions
        //  clean special characters
        // check for injections
        //  new post
        //  attach to channel
        //  attach to tag
        // upload images
        //  set images to database.
        // return post object.

        $url = $options['url'];
        $tagsObjects = [];
        //Channel checks

        try {

            $user = User::findOrFail($authorId);
            $channel = Topic::findOrFail($channelId);



            foreach ($tagIds as $tag) {
                $tagsObjects[] = Tag::findOrFail($tag);
            }

            $check = $user->topics->findOrFail($channel);

            if  (!isset($check)) {
                $user->topics()->attach($channel);
            }

        } catch (\Exception $e) {

            if  (!isset($user) && !isset($channel)) {
                throw new \Exception('Critical Error: data required does not exist');
            }

        }

//refactor process

        $charsToRemove = array('&lt;', '&gt;');
        $text = str_replace($charsToRemove, '', $content);
        $text = strip_tags($text, '<a>');
        $text= '<div class="user-text">'.$text.'</div>';
        //Add links to mentioned users
        $sendMentions = array();
        if(isset($options['mentionedUsers']))
        {
            $mentionedUsers = $options['mentionedUsers'];
            foreach($mentionedUsers as $user)
            {
                $link = '<a class="mentions" href="'.$user['url'].'">'.$user['name'].'</a>';
                $text = str_replace($user['name'], $link, $text);
                array_push($sendMentions, $user['id']);
            }
        }
        if(isset($options['attachment']) && $options['attachment'] != 'false')
        {
            $attachment = str_replace('<a class="btn btn-default btn-xs" id="remove-link"><i class="fa fa-times"></i></a>', '', $options['attachment']);

            $text .= $attachment;
        }
        $post = new Post;
        if(isset($options['anonymous']))
            $post->anonymous = 1;
        //$post->user_id = (int) $user->id;
        $post->title = strip_tags($options['title']);
        $post->type = 'post';
        $post->text = "<a class='hidden' href='$url'>$url</a>". $text;
        $post->user()->associate(Auth::user());
        $post->save();
        $this->sync($post->id, $topic, $options['niche']);

        if($sendMentions)
        {
            foreach($sendMentions as $user_id)
            {
                $this->mentionedActivity($user_id,$post->id);
            }
        }
        if(isset($options['images']))
        {
            $publicImages = array();
            $images = $options['images'];
            foreach($images as $image)
            {
                $key = explode('cache/', $image['url']);
                try
                {
                    $s3Client = $this->connect();
                    $result = $s3Client->putObject(array(
                        'Bucket' 	  => 'p-img',
                        'Key'	 	  => $key[1],
                        'SourceFile'   => $image['url'],
                        'ACL'    => 'public-read',
                        'ContentType' => $image['mimeType']
                    ));
                    $url = $result['ObjectURL'];
                    $thumbnail = 'cache/thumbs/'.$key[1];
                    $result = $s3Client->putObject(array(
                        'Bucket' 	  => 'pt-img',
                        'Key'	 	  => $key[1],
                        'SourceFile'   => $thumbnail,
                        'ACL'    => 'public-read',
                        'ContentType' => $image['mimeType']
                    ));
                    $thumb_url = $result['ObjectURL'];
                    $img = array('url' => $url, 'thumbnail' => $thumb_url);
                    array_push($publicImages, $img);
                    unlink($image['url']);
                    unlink($thumbnail);
                }
                catch (S3Exception $e)
                {
                    return $e->getMessage() . "\n";
                }
            }
            foreach($publicImages as $image)
            {
                //attach to post and store public images in database
                $options = array
                (
                    'url' => $image['url'],
                    'thumb_url' => $image['thumbnail'],
                    'owner' => Auth::id(),
                    'post_id' => $post->id,
                    'channel_id' => $topic
                );
                DB::table('post_images')->insert($options);
            }
        }
    }

    /**
     * @param $postId
     * @return mixed
     */
    public function delete($postId)
    {
        // TODO: Implement delete() method.
    }

    /**
     * @param $postId
     * @param null $title
     * @param null $content
     * @param array $tags
     * @return mixed
     */
    public function update($postId, $title = null, $content = null, $tags = [])
    {
        // TODO: Implement update() method.
    }

    /**
     * @param $postId
     * @param $content
     * @param $channel
     * @param array $tags
     * @return mixed
     */
    public function share($postId, $content, $channel, $tags = [])
    {
        // TODO: Implement share() method.
    }

}