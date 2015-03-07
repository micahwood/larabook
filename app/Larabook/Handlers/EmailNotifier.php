<?php namespace Larabook\Handlers;

use Laracasts\Commander\Events\EventListener;
use Larabook\Mailers\Mailer;
use Larabook\Registration\Events\UserHasRegistered;
use Larabook\Users\User;
use Larabook\Mailers\UserMailer;

class EmailNotifier extends EventListener {

  private $mailer;

  function __construct(UserMailer $mailer)
  {
    $this->mailer = $mailer;
  }

  public function whenUserHasRegistered(UserHasRegistered $event)
  {
    $this->mailer->sendWelcomeMessageTo($event->user);
  }
}