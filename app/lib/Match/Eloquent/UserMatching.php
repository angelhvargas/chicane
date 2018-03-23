<?php
/**
 * Created by Silooette.
 * User: Angel Vargas
 * Date: 15/04/2015
 * Time: 16:47
 */

namespace Sil\Match\Eloquent;

use Illuminate\Database\Eloquent\Collection as Collection;
use Sil\Match\MatchingInterface as MatchingInterface;
use User;


/**
 * Class UserMatching
 * @package Sil\Match\Eloquent
 */
class UserMatching implements MatchingInterface
{

    /**
     * @var User
     */
    protected $user;

    /**
     * @var
     */
    public $matches;

    /**
     * @var MatchingQueries
     */
    public $queries;

    /**
     * @var
     */
    public $session;

    /**
     * @param User $user
     */
    public function __construct(User $user, MatchingQueries $queries)
    {
        $this->queries = $queries;
        $this->user = $user;
    }


    /**
     * @param $modelToMatch
     * @param null $discardedUsersArray
     * @param null $toArray
     * @return array|null
     */
    public function getUserMatches($user, $modelToMatch, $discardedUsersArray = null, $toArray = null)
    {
        $matches = $this->queries->startMatch($user, $modelToMatch, $discardedUsersArray);
        if (count($matches) > 0) {
            $this->setMatches($this->toCollection($matches)->sortBy('percentage', 0, true)->values());

            return $this->getMatches($toArray);
        } else
            return [];

    }


    /**
     * @param null $toArray
     * @return array|null
     */
    public function getMatches($toArray = null)
    {
        if (is_null($toArray)) {
            return $this->matches;
        } else if ($toArray == true) {
            $array = [];
            foreach ($this->matches as $match) {
                $array[] = $match->id;
            }
            return $array;
        } else
            return null;
    }


    /**
     * @param $matches
     */
    public function setMatches($matches)
    {
        $this->matches = $matches;
    }


    /**
     * @param $matches
     * @return array|Collection
     */
    private function toCollection($matches)
    {
        User::unguard();
        if (empty($matches)) return [];

        $userModels = [];

        foreach ($matches as $match) {
            $userModels[] = new User((array)$match);
        }
        User::reguard();
        return new Collection($userModels);
    }


}