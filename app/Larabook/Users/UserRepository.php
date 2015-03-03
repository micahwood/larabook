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
    return User::with(['statuses' => function($query)
    {
      $query->latest();
    }])->whereUsername($username)->first();
  }
}