<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BackupSuccessfulMail extends Mailable
{
  use Queueable, SerializesModels;

  public $tenant;

  /**
   * Create a new message instance.
   *
   * @param $tenant
   */
  public function __construct($tenant)
  {
    $this->tenant = $tenant;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build(): BackupSuccessfulMail
  {
    return $this->from("system@salvationclincchms.com", "SCIM CHMS")
      ->subject("Successful backup for " . $this->tenant)
      ->view("email.system.backup_successful");
  }
}
