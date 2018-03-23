<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 25/05/2015
 * Time: 17:17
 */

namespace Sil\Comments\Replies\Anonymous;


use Sil\Commanding\CommandHandler;
use Sil\Repositories\Comment\Eloquent\EloquentCommentRepository;
use Sil\Eventing\EventDispatcher;

/**
 * Class AnonymousPostCommentReplyCommandHandler
 * @package Sil\Comments\Replies\Anonymous
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