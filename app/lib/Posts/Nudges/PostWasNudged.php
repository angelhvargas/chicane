<?php

namespace Chicane\Posts\Nudges;

use Nudge;

/**
 * Class PostWasNudged
 * @package Chicane\Posts\Nudges
 */
class PostWasNudged
{
    /**
     * @var Nudge
     */
    public $nudge;

    /**
     * PostWasNudged constructor.
     * @param $nudge
     */
    public function __construct(Nudge $nudge)
    {
        $this->nudge = $nudge;
    }

}