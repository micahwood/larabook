<?php namespace Larabook\Users;

class UserRepository {

  /**
   * Persist a user
   *
   * @param  User   $user
   * @return User
   */
  public function save(User $user)
  {
    return $user->save();
  }

  /**
   * Get a paginated list of all users
   *
   * @param  integer $howMany
   * @return Users
   */
  public function getPaginated($howMany = 25)
  {
    return User::orderBy('username', 'asc')->simplePaginate($howMany);
  }

  /**
   * Fetch a user by their username
   *
   * @param $username
   * @return User
   */
  public function findByUsername($username)
  {
    return User::with('statuses')->whereUsername($username)->first();
  }

  /**
   * Find a user by their id
   *
   * @param $id
   * @return User
   */
  public function findById($id)
  {
    return User::findOrFail($id);
  }

  /**
   * Follow a Larabook user
   *
   * @param $userIdToFollow
   * @param User $user
   * @return User
   */
  public function follow($userIdToFollow, User $user)
  {
    return $user->followedUsers()->attach($userIdToFollow);
  }

  /**
   * Unfollow a Larabook user
   *
   * @param $userIdToUnfollow
   * @param User $user
   * @return User
   */
  public function unfollow($userIdToUnfollow, User $user)
  {
    return $user->followedUsers()->detach($userIdToUnfollow);
  }
}