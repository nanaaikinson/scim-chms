<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MemberResendOTPMail extends Mailable implements ShouldQueue
{
  use Queueable, SerializesModels;

  public $user;

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
  public function build(): MemberResendOTPMail
  {
    return $this->from("no-reply@salvationclincchms.com", "SCIM")
      ->subject("Activate your account with " . $this->user->token)
      ->view("email.member.verification");
  }
}
