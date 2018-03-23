<?php
/**
 * Created by Angel Vargas.
 * User: Angel
 * Date: 16/04/2015
 * Time: 11:11
 */

namespace Sil\Match\Eloquent;

use User;

/**
 * Class MatchingQueries
 * @package Sil\Match\Eloquent
 */
class MatchingQueries
{
    /**
     * @var User
     */
    protected $user;
    /**
     * @var array
     */
    protected $matches = [];


    /**
     * @param $modelToMatchOn
     * @return array|Collection
     */
    public function startMatch(User $user, $modelToMatchOn = [], $discardedUsersArray = null)
    {
        $this->user = $user;
        $candidates = $this->getCandidates($discardedUsersArray);

        if (count($candidates) > 1) {
            foreach ($candidates as $candidate) {
                $value = 0;
                foreach ($modelToMatchOn as $model) {
                    if ($this->isValidRelationshipToMatch($model))
                        $value += $this->percentageOfMatch($this->user, $candidate, $model);
                }

                $numPosts = $candidate->posts()->where('anonymous', '<>', 1)->count() > 1 ? 1 : 0;
                $candidate['percentage'] = $value;
                if ($value > 1 && $numPosts) {
                    array_push($this->matches, $candidate->toArray());
                }
            }

            return $this->matches;
        } else {
            return [];
        }


    }

    /**
     * @param $relationship
     * @return string
     * @throws \Exception
     */
    private function modelRelationshipToClass($relationship)
    {
        $string = rtrim($relationship, 's');
        $string = ucwords($string);

        if (class_exists($string)) {
            return $string;
        } else {
            throw new \Exception;
        }

    }

    /**
     * @param User $user
     * @param $modelCollection
     * @param $collectionToIntersect
     * @return mixed
     */
    private function numberOfMatchesObjects(User $user, $modelCollection, $collectionToIntersect)
    {
        return (int)$user->{$modelCollection}->intersect($collectionToIntersect)->count();
    }

    /**
     * @param User $user
     * @param $modelCollection
     * @return mixed
     */
    private function objectsToIntersect(User $user, $modelCollection)
    {
        return $user->{$modelCollection}()->get();
    }

    /**
     * @param User $user
     * @param User $userToMatch
     * @param $modelCollection
     * @return float
     */
    private function percentageOfMatch(User $user, $userToMatch, $modelCollection)
    {
        $intersectionVortex = $this->objectsToIntersect($userToMatch, $modelCollection);
        $matchesCount = $this->numberOfMatchesObjects($user, $modelCollection, $intersectionVortex);
        if ($user->{$modelCollection}->count() <> 0)
            return floatval((($matchesCount / $user->{$modelCollection}->count()) * 100));
        else
            return 0;
    }

    /**
     * @param $id
     * @return mixed
     */
    private function getCandidates($discardedUsersArray = null)
    {
        return User::whereNotIn('id', function ($query) {
            $query->select('target_id')
                ->from('user_follows')
                ->join('users', 'user_follows.user_id', '=', 'users.id', 'left outer')
                ->where('users.id', $this->user->id);
        })->whereNotIn('id', function ($query) {
            $query->select('follow_id')
                ->from('topic_follows')
                ->join('users', 'topic_follows.follow_id', '=', 'users.id', 'left outer')
                ->where('users.id', $this->user->id);
        })->whereNotIn('id', $discardedUsersArray)
            ->where('id', '!=', $this->user->id)
            ->get();

    }

    /**
     * @param $model
     * @return int
     */
    private function isValidRelationshipToMatch($model)
    {
        if (is_null($this->user->{$model})) {
            return 0;
        } else
            return 1;
    }
}