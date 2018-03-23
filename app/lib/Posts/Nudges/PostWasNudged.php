<?php

namespace Sil\Posts\Nudges;

use Nudge;

/**
 * Class PostWasNudged
 * @package Sil\Posts\Nudges
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