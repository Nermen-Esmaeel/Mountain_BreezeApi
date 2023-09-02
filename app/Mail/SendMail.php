<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
// use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    public $mailData;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct()
    {
        $this->mailData = $mailData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(

           // from: new Address('jeffrey@example.com', 'Jeffrey Way'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contactemail',
            with: [
                'full_name' =>$this->mailData['full_name'],
                'email' =>$this->mailData['email'],
                'phone' =>$this->mailData['phone'],
                'subject' =>$this->mailData['subject'],
                'content' =>$this->mailData['content'],
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
