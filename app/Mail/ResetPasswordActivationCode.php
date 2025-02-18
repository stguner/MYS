<?php

namespace App\Mail;

use App\Models\ActivationCode;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPasswordActivationCode extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $activationCode;
    public $text;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $subject, ActivationCode $activationCode = null, string $text)
    {
        $this->subject = $subject;
        $this->activationCode = $activationCode;
        $this->text = $text;
    }


    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address('20190808018@ogr.akdeniz.edu.tr', 'MYS'),
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.reset_password',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
