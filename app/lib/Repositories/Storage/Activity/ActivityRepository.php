<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 14/05/2015
 * Time: 14:26
 */

namespace Chicane\Repositories\Storage\Activity;


interface ActivityRepository {

    public function create($senderId, $userId, $objectRelated);

}