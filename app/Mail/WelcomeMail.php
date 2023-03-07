<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;


    public function build()
    {
        return $this->from('do_not_reply@turkeysuppliers.online', 'مرحبا بكم')
            ->subject('رسالة ترحيبية')
            ->view('emails.welcome');
    }
}
