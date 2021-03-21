<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MemberRegistrationOTPMail extends Mailable implements ShouldQueue
{
  use Queueable, SerializesModels;

  public $user;
  public $registration = true;

  /**
   * Create a new message instance.
   *
   * @param $user
   */
  public function __construct($user)
  {
    $this->user = $user;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build(): MemberRegistrationOTPMail
  {
    return $this->from("no-reply@salvationclincchms.com", "SCIM")
      ->subject("Account verification with " . $this->user->token)
      ->view("email.member.register");
  }
}
