<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 29/10/2015
 * Time: 21:56
 */

namespace Chicane\Repositories\Storage\Nudge;


interface NudgeRepository
{

    public function toggle($userId, $object, $reason);

}