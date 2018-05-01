<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 07/05/2015
 * Time: 12:51
 */

namespace Chicane\Comments\Anonymous;
use Chicane\Eventing\EventDispatcher;
use Chicane\Commanding\CommandHandler;
use Chicane\Repositories\Comment\Eloquent\EloquentCommentRepository;

class StoreAnonymousPostCommentCommandHandler implements CommandHandler{

    private $comment;
    private $dispatcher;

    /**
     * StorePostCommentCommandHandler constructor.
     * @param $comment
     */
    public function __construct(EloquentCommentRepository $comment, EventDispatcher $dispatcher)
    {
        $this->comment = $comment;
        $this->dispatcher = $dispatcher;
    }

    /**
     * Handle the command
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        $comment = $this->comment->create($command->userId, $command->postId, $command->content, null, 1);
        $this->dispatcher->dispatch($comment->releaseEvents());

        return $comment;
    }


}