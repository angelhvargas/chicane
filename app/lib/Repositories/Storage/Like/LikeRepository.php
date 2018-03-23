<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 20/05/2015
 * Time: 11:24
 */

namespace Sil\Repositories\Storage\Like;


interface LikeRepository {

    public function toggle($senderId, $object);

}