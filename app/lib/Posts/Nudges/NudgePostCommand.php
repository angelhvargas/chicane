<?php

namespace Chicane\Posts\Nudges;


/**
 * Class NudgePostCommand
 * @package Chicane\Posts\Nudges
 */
/**
 * Class NudgePostCommand
 * @package Chicane\Posts\Nudges
 */
class NudgePostCommand
{
    /**
     * @var
     */
    public $userId;
    /**
     * @var
     */
    public $object;
    /**
     * @var
     */
    public $reason;

    /**
     * NudgePostCommand constructor.
     * @param $userId
     * @param $object
     * @param $reason
     */
    public function __construct($userId, $object, $reason)
    {
        $this->userId = $userId;
        $this->object = $object;
        $this->reason = $reason;
    }


}