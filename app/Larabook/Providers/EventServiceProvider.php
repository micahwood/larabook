<?php namespace Larabook\Providers;

use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider {

  /**
   * Regiser Larabook events listener
   */
  public function register()
  {
    $this->app['events']->listen('Larabook.*', 'Larabook\Handlers\EmailNotifier');
  }
}