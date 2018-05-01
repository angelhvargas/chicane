<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 07/05/2015
 * Time: 17:44
 */

namespace Chicane\Comments\Delete;

use Chicane\Repositories\Comment\Eloquent\EloquentCommentRepository;
use Chicane\Commanding\CommandHandler;

class DeletePostCommentCommandHandler implements CommandHandler{

    protected $comment;

    protected $dispatcher;

    /**
     * DeletePostCommentCommandHandler constructor.
     * @param $comment
     */
    public function __construct(EloquentCommentRepository $comment)
    {
        $this->comment = $comment;
    }


    /**
     * Handle the command
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {

        return $this->comment->delete($command->commentId);

    }


}