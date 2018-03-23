<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 08/05/2015
 * Time: 12:33
 */

namespace Sil\Comments;



class StorePostCommentValidator {

    protected static $rules = [
        'userId' => 'required|integer',
        'content' => 'required|string:1000',
        'postId' => 'required|integer' ];

    public function validate(StorePostCommentCommand $command)
    {
        $validator = Validator::make
        ( [
            'userId' => $command->userId ,
            'content' => $command->content,
            'postId' => $command->postId],

            static::rules );

        if( $validator->fails() )
        {
            return null;
        }
    }



}