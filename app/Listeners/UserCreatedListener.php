<?php

namespace App\Listeners;

use App\Events\UserCreatedEvent;
use App\Mail\UserCreatedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class UserCreatedListener
{
  /**
   * Create the event listener.
   *
   * @return void
   */
  public function __construct()
  {
    //
  }

  /**
   * Handle the event.
   *
   * @param UserCreatedEvent $event
   * @return void
   */
  public function handle(UserCreatedEvent $event)
  {
    Mail::to($event->user->email)->queue(new UserCreatedMail([
      "name" => $event->user->first_name,
      "email" => $event->user->email,
      "password" => $event->password
    ]));
  }
}
