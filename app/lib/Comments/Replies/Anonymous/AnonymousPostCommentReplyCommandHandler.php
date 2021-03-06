<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 25/05/2015
 * Time: 17:17
 */

namespace Chicane\Comments\Replies\Anonymous;


use Chicane\Commanding\CommandHandler;
use Chicane\Repositories\Comment\Eloquent\EloquentCommentRepository;
use Chicane\Eventing\EventDispatcher;

/**
 * Class AnonymousPostCommentReplyCommandHandler
 * @package Chicane\Comments\Replies\Anonymous
 */
class AnonymousPostCommentReplyCommandHandler implements CommandHandler
{
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
        $comment = $this->comment->create($command->userId, $command->postId, $command->content, $command->parentId, 1);

        if( !is_null($comment) )
        {
            $this->dispatcher->dispatch($comment->releaseEvents());
        }

        return $comment;
    }

}