<?php

namespace Sil\Posts\Nudges;


/**
 * Class NudgePostCommand
 * @package Sil\Posts\Nudges
 */
/**
 * Class NudgePostCommand
 * @package Sil\Posts\Nudges
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