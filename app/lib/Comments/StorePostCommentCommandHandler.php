<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 07/05/2015
 * Time: 12:51
 */

namespace Sil\Comments;
use Sil\Eventing\EventDispatcher;
use Sil\Commanding\CommandHandler;
use Sil\Repositories\Comment\Eloquent\EloquentCommentRepository;
use Illuminate\Support\Facades\Log;

class StorePostCommentCommandHandler implements CommandHandler{

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
        $comment = $this->comment->create($command->userId, $command->postId, $command->content);

        if( !is_null($comment) )
        {
            $this->dispatcher->dispatch($comment->releaseEvents());
        }

        return $comment;
    }


}