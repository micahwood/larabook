<?php namespace Larabook\Statuses;

class Comment extends \Eloquent {

	/**
	 * Fillable fields
	 *
	 * @var array
	 */
	protected $fillable = ['user_id', 'status_id', 'body'];

	/**
	 * A status belongs to a user
	 *
	 * @return mixed
	 */
	public function owner()
	{
		return $this->belongsTo('Larabook\Users\User', 'user_id');
	}

	/**
	 * Leave a new comment
	 *
	 * @param $body
	 * @param $statusId
	 * @return Comment
	 */
	public static function leave($body, $statusId)
	{
		return new static([
			'body' => $body,
			'status_id' => $statusId
		]);
	}
}