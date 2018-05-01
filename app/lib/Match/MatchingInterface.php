<?php
/**
 * Created by Silooette.
 * Developer: Angel Vargas
 * Date: 15/04/2015
 * Time: 16:53
 */

namespace Chicane\Match;

/**
 * Interface MatchingInterface
 * @package Chicane\Match
 */
interface MatchingInterface
{

    /**
     * @param $user
     * @param $modelToMatch
     * @return mixed
     */
    public function getUserMatches($user, $modelToMatch);

}