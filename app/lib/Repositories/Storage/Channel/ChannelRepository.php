<?php

namespace Chicane\Repositories\Channel;

interface ChannelRepository {

	public function create($name);
	public function getGlobalChannelsTiers();
	public function getChannelGroup($channelId);
	public function setChannelGroup($channelId, $channelGroup);
	public function getUserChannelsTiers($userId);
	public function getActualUserChannels($userId);
	public function setChannelToTrends($channelId);
	public function unsetChannelToTrends($channelId);
	public function setChannelPicture($channelId, $pictureUrl);
	public function updateChannelName($channelId,  $name);
	public function updateChannelSlug($channelId, $slug);
} 