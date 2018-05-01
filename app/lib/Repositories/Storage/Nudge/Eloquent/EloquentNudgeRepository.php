<?php


namespace Chicane\Repositories\Storage\Nudge\Eloquent;


use Chicane\Eventing\EventListenerTranslator;
use Chicane\Repositories\Storage\Nudge\NudgeRepository;
use User;
use Nudge;

/**
 * Class EloquentNudgeRepository
 * @package Chicane\Repositories\Storage\Nudge\Eloquent
 */
class EloquentNudgeRepository implements NudgeRepository
{
    /**
     * @var EventListenerTranslator
     */
    protected $translator;

    /**
     * EloquentNudgeRepository constructor.
     * @param $translator
     */
    public function __construct(EventListenerTranslator $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @param $userId
     * @param $object
     * @param $reason
     * @return Nudge|null|string
     */
    public function toggle($userId, $object, $reason)
    {
        $nudge= null;
        try {
            if ($object->nudged($userId)) {
                $object->setRemovedNudge();
            } else {
                User::findOrFail($userId);
                $nudge = new Nudge;
                $nudge->setFrom(User::findOrFail($userId))
                    ->setTo($object->user)
                    ->setRegarding($object)
                    ->setReason($reason)
                    ->set();
                $nudge->raise($this->translator->toEventListener($object, 'WasNudged', $nudge));
            }
        } catch (\Exception $e) {
            return "Something went wrong here: $e->getMessage()";
        }

        return $nudge;
    }

    /**
     * @param $id
     * @return string
     */
    public function remove($id)
    {
        try {
            $nudge = Nudge::findOrFail($id);
            $status = $nudge->delete();
        } catch(\Exception $e) {
            return "Something went wrong here: $e->getMessage()";
        }

        return $status;

    }


}