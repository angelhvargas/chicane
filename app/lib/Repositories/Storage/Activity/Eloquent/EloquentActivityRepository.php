<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 14/05/2015
 * Time: 14:30
 */

namespace Chicane\Repositories\Storage\Activity\Eloquent;

use Chicane\Repositories\Storage\Activity\ActivityRepository;
use Activity;

/**
 * Class EloquentActivityRepository
 * @package Chicane\Repositories\Storage\Activity\Eloquent
 */
class EloquentActivityRepository implements ActivityRepository{


    /**
     * @param $senderId
     * @param $userId
     * @param $objectRelated
     * @return $this|Activity|string
     */
    public function create($senderId, $userId, $objectRelated)
    {

        try
        {
            $activity = new Activity();
            $activity = $activity->setRegarding($objectRelated)
                ->setFrom($senderId)
                ->setSubject($objectRelated->user->id)
                ->set();
        }
        catch(\Exception $e)
        {
            return 'An Error occurred ' . $e;
        }

        return $activity;
    }

    public function setRead($activityId)
    {
        try
        {
            $activity = Activity::find($activityId)->first();
            $activity = $activity->setRead();
        }
        catch(\Exception $e)
        {
            return 'An Error occurred ' . $e;
        }

        return $activity;
    }

}