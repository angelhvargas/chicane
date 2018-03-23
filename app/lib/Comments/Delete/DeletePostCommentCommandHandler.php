<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 07/05/2015
 * Time: 17:44
 */

namespace Sil\Comments\Delete;

use Sil\Repositories\Comment\Eloquent\EloquentCommentRepository;
use Sil\Commanding\CommandHandler;

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