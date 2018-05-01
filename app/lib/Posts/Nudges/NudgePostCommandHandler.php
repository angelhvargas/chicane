<?php

namespace Chicane\Posts\Nudges;

use Chicane\Eventing\EventDispatcher;
use Chicane\Repositories\Storage\Nudge\Eloquent\EloquentNudgeRepository;

/**
 * Class NudgePostCommandHandler
 * @package Chicane\Posts\Nudges
 */
class NudgePostCommandHandler
{
    /**
     * @var EloquentNudgeRepository
     */
    private $nudge;
    /**
     * @var EventDispatcher
     */
    private $dispatcher;

    /**
     * @param EloquentNudgeRepository $nudge
     * @param EventDispatcher $dispatcher
     */
    public function __construct(EloquentNudgeRepository $nudge, EventDispatcher $dispatcher)
    {
        $this->nudge = $nudge;
        $this->dispatcher = $dispatcher;
    }


    /**
     * Handle the command
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        $nudge = $this->nudge->toggle($command->userId, $command->object, $command->reason);
        if (!is_null($nudge) && (get_class($nudge) == 'Nudge')) {
            $this->dispatcher->dispatch($nudge->releaseEvents());
        }

        return $nudge;

    }

}