<?php

namespace Sil\Posts\Nudges;

use Sil\Eventing\EventDispatcher;
use Sil\Repositories\Storage\Nudge\Eloquent\EloquentNudgeRepository;

/**
 * Class NudgePostCommandHandler
 * @package Sil\Posts\Nudges
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