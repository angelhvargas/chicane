<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 25/05/2015
 * Time: 16:52
 */

namespace Chicane\Comments\Replies;

use Chicane\Commanding\CommandHandler;
use Chicane\Repositories\Comment\Eloquent\EloquentCommentRepository;
use Chicane\Eventing\EventDispatcher;


/**
 * Class StorePostCommentReplyCommandHandler
 * @package Chicane\Comments\Replies
 */
class StorePostCommentReplyCommandHandler implements CommandHandler{


    /**
     * @var EloquentCommentRepository
     */
    private $comment;

    /**
     * @var EventDispatcher
     */
    private $dispatcher;


    /**
     * @param EloquentCommentRepository $comment
     * @param EventDispatcher $dispatcher
     */
    public function __construct(EloquentCommentRepository $comment, EventDispatcher $dispatcher)
    {
        $this->comment = $comment;
        $this->dispatcher = $dispatcher;
    }


    /**
     * @param $command
     * @return \Comment|string
     */
    public function handle($command)
    {
        $comment = $this->comment->create($command->userId, $command->postId, $command->content, $command->parentId, null);

        if( !is_null($comment) )
        {
            $this->dispatcher->dispatch($comment->releaseEvents());
        }

        return $comment;
    }
}