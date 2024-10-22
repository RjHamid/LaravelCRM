<?php

namespace Modules\User\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $code;
    /**
     * Create a new message instance.
     */
    public function __construct($code)
    {
        $this->code = $code;
    }
    public function envelope(): Envelope  
    {  
        return new Envelope(  
            subject: 'Your Confirmation Code',  
            from: 'hello@demomailtrap.com ' 
        );  
    }

    /**
     * Build the message.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email',
        );
    }
    public function attachments(): array
    {
        return [];
    }
}
