<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VisitorMail extends Mailable
{
    use Queueable, SerializesModels;

    public $visitor;
    public $contact_supplier;
    public $files;

    public function __construct($visitor,$contact_supplier)
    {
        $this->visitor = $visitor;
        $this->contact_supplier = $contact_supplier;
    }
    public function build()
    {

        return $this->from('do_not_reply@turkeysuppliers.online', 'مرحبا بكم')
            ->subject(__('email.welcomesms') . $this->visitor->name)
            ->view('emails.visitoremail')
            ->with([
                'visitor' => $this->visitor,
                'contact_supplier' => $this->contact_supplier,
            ]);
    }
}
