<?php 
namespace Sil\Repositories\Storage\User\Eloquent;
use Sil\Repositories\Storage\User\UserRepository as UserRepository;
use User;
use Redirect;
use Validator;
use Hash;
use View;
use Session;
use DB;
use Topic;
use InviteCode;
use Match;

/**
 * Class EloquentUserRepository
 * @package Sil\Repositories\Storage\User\Eloquent
 */
class EloquentUserRepository implements UserRepository {

	/**
	 * @var
     */
	protected $user;

	/**
	 * @param $user_data
	 * @return User
     */
	public function create($user_data)
	{
		$first_name = ucfirst(strtolower($user_data['first_name']));
		$last_name = ucfirst(strtolower($user_data['last_name']));
		//User default
		$user = new User;
		$user->pseudoname = $user_data['username_register'];
		$user->email = $user_data['email-register'];
		$user->confirmed = '0';
		$user->confirm_code = str_random(32);
		$user->active = '1';
		$user->password = Hash::make($user_data['password-register']);
		$user->firstname = $first_name;
		$user->surname = $last_name;
		if(isset($user_data['generatePseudo']))
			$user->use_pseudo = '1';
		$user->save();

		return $user;
	}

	/**
	 * @param $id
	 * @param $data
     */
	public function update($id, $data)
	{
		// TODO: Implement update() method.
	}

	/**
	 * @param $id
     */
	public function delete($id)
	{
		// TODO: Implement delete() method.
	}

	/**
	 * @param User $from
	 * @param User $to
     */
	public function follow(User $from, User $to)
	{
		// TODO: Implement follow() method.
	}


}