<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MemberRegisteredMail extends Mailable implements ShouldQueue
{
  use Queueable, SerializesModels;

  public $data;

  /**
   * Create a new message instance.
   *
   * @param $data
   */
  public function __construct($data)
  {
    $this->data = $data;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    return $this->subject("{$this->data['token']} is login/email verification code")
      ->view('email.member.created');

  }
}
