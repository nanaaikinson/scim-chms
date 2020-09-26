<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DeveloperTicketMail extends Mailable implements ShouldQueue
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
    return $this->from("noreply@salvationclincchms.com", "SCIM CHMS")
      ->subject("Ticket #{$this->data['ticket']->id} {$this->data['action']}")
      ->view("email.developer.ticket.index");
  }
}
