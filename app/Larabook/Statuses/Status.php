<?php namespace Larabook\Statuses;

use Laracasts\Commander\Events\EventGenerator;
use Laracasts\Presenter\PresentableTrait;
use Larabook\Statuses\Events\StatusWasPublished;
use Eloquent;

class Status extends Eloquent {

  use EventGenerator, PresentableTrait;

  /**
   * Fillable fields for a new status
   *
   * @var array
   */
  protected $fillable = ['body'];

  /**
   * Path to the presenter of a status
   *
   * @var string
   */
  protected $presenter = 'Larabook\Statuses\StatusPresenter';

  /**
   * A status belongs to a user
   *
   * @return mixed
   */
  public function user()
  {
    return $this->belongsTo('Larabook\Users\User');
  }

  /**
   * Publish a new status
   *
   * @param $body
   * @return status
   */
  public static function publish($body)
  {
    $status = new static(compact('body'));

    $status->raise(new StatusWasPublished($body));

    return $status;
  }
}