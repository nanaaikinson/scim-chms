<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BackupFailureMail extends Mailable
{
  use Queueable, SerializesModels;

  public $tenant;
  public $message;

  /**
   * Create a new message instance.
   *
   * @param $tenant
   * @param $message
   */
  public function __construct($tenant, $message)
  {
    $this->tenant = $tenant;
    $this->tenant = $message;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build(): BackupFailureMail
  {
    return $this->from("system@salvationclincchms.com", "SCIM CHMS")
      ->subject("Failed backup for " . $this->tenant)
      ->view("email.system.backup_failure");
  }
}
