<?php namespace Chicane\Repositories\Storage\User;
 use User;
interface UserRepository 
{
	public function create($user_data);
	public function update($id, $data);
	public  function delete($id);
	public function follow(User $from, User $to);
}