<?php namespace Sil\Posts\Likes;


use Sil\Commanding\CommandHandler;
use Sil\Eventing\EventDispatcher;
use Sil\Repositories\Storage\Like\Eloquent\EloquentLikeRepository;

class LikePostCommandHandler implements CommandHandler {

    private $like;
    private $dispatcher;

    /**
     * LikePostCommentCommandHandler constructor.
     * @param $like
     * @param $dispatcher
     */
    public function __construct(EloquentLikeRepository $like, EventDispatcher $dispatcher)
    {
        $this->like = $like;
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
        $like = $this->like->toggle($command->userId, $command->object);

        if(!is_null($like))
        {
           $this->dispatcher->dispatch($like->releaseEvents());
        }



        return $like;

    }


}