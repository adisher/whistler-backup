<?php
/*
@copyright

Fleet Manager v6.1

Copyright (C) 2017-2022 Hyvikk Solutions <https://hyvikk.com/> All rights reserved.
Design and developed by Hyvikk Solutions <https://hyvikk.com/>

 */
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ServiceReminderEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $emailTitle;
    public $reminder;

    public function __construct($reminder, $emailTitle)
    {
        $this->reminder = $reminder;
        $this->emailTitle = $emailTitle;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Service Reminder: {$this->emailTitle}")
            ->markdown('emails.service_reminder')->with([
                    'title' => $this->emailTitle,
                ]);;
    }

}
