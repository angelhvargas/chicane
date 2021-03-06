<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 20/05/2015
 * Time: 11:23
 */

namespace Chicane\Repositories\Storage\Like\Eloquent;


use Aws\CloudFront\Exception\Exception;
use Chicane\Repositories\Storage\Like\LikeRepository;
use Chicane\Comments\Likes\CommentWasLiked;
use Chicane\Eventing\EventListenerTranslator;
use User;
use Like;

/**
 * Class EloquentLikeRepository
 * @package Chicane\Repositories\Storage\Like\Eloquent
 */
class EloquentLikeRepository implements LikeRepository{

	protected $translator;
	
	public function __construct(EventListenerTranslator $translator)
	{
		$this->translator = $translator;
	}
	
    /**
     * @param $senderId
     * @param $object
     * @return Like|null|string
     */
    public function toggle($senderId, $object)
    {
        try
        {
            if  ($object->liked($senderId) == 1) {

                $object->setRemoveLike();
                $like = null;
            } else {
                $like = new Like;
                $like->setFrom( User::find($senderId) )
                    ->setTo( $object->user )
                    ->setRegarding( $object );
                $like->set();
                //trigger the event to the queue
				$like->raise($this->translator->toEventListener($object, 'WasLiked', $like));
            }
        }
        catch(Exception $e)
        {
            return 'Something bad just occurred ' . $e;
        }

        return $like;
    }

}