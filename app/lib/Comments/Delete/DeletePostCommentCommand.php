<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 07/05/2015
 * Time: 17:42
 */

namespace Sil\Comments\Delete;


class DeletePostCommentCommand {

    public $commentId;

    /**
     * DeletePostCommentCommand constructor.
     * @param $commentId
     */
    public function __construct($commentId)
    {

        $this->commentId = $commentId;

    }


}