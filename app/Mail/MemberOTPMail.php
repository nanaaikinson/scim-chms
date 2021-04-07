<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MemberOTPMail extends Mailable implements ShouldQueue
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
  public function build(): MemberOTPMail
  {
    return $this->from("noreply@salvationclincchms.com", "SCIM")
      ->subject("Account OTP Verification")
      ->view("email.member.otp");
  }
}
