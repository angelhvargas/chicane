<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 24/04/2015
 * Time: 16:24
 */

namespace Sil\Match\Session;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Session\Store as Session;

class MatchSession {

    private $session;

    /**
     * MatchSession constructor.
     * @param $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function setMatchesToStorage(Collection $matches)
    {
        $i = 0;
        foreach($matches as $match)
        {
            $this->session->set('matches.' . $i, $match);
            $i += 1;
        }
    }

    public function getNextMatch()
    {

    }

}