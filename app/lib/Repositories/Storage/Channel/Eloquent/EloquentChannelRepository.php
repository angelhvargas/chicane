<?php

namespace Sil\Repositories\Channel\Eloquent;
use Sil\Repositories\Channel\ChannelRepository;
use Topic;

class EloquentChannelRepository implements ChannelRepository{
	public function create($name)
	{
		// TODO: Implement create() method.
	}

	public function getChannelGroup($channelId)
	{
		// TODO: Implement getChannelGroup() method.
	}

	public function setChannelGroup($channelId, $channelGroup)
	{
		// TODO: Implement setChannelGroup() method.
	}

	public function getGlobalChannelsTiers()
	{
		// TODO: Implement getGlobalChannelsTiers() method.
	}

	public function getUserChannelsTiers($userId)
	{
		$user = User::find($userId);
		$channels = $user->topics;

		if( is_null($channels) )
		{
			$channels = Topic::getTrends();

		}
		else
		{

		}
	}

	public function getActualUserChannels($userId)
	{
		// TODO: Implement getActualUserChannels() method.
	}

	public function setNewUserChannel($userId, $channelId)
	{
		// TODO: Implement setNewUserChannel() method.
	}

	public function unsetUserChannel($userId, $channelId)
	{
		// TODO: Implement unsetUserChannel() method.
	}

	public function setChannelToTrends($channelId)
	{
		// TODO: Implement setChannelToTrends() method.
	}

	public function unsetChannelToTrends($channelId)
	{
		// TODO: Implement unsetChannelToTrends() method.
	}

	public function setChannelPicture($channelId, $pictureUrl)
	{
		// TODO: Implement setChannelPicture() method.
	}

	public function updateChannelName($channelId, $name)
	{
		// TODO: Implement updateChannelName() method.
	}

	public function updateChannelSlug($channelId, $slug)
	{
		// TODO: Implement updateChannelSlug() method.
	}#


}