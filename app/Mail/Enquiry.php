<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;


class Enquiry extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($email)
    {
        $this->email = $email;
    }
    public $email;

    public function build()
    {
        return $this->from($this->email, 'Enquiry Us')
            ->view('mail.enquiry') // Use the appropriate email view file
            ->with([
                'email' => $this->email,
            ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            // from: new Address("cit22015@zslsz.com", "Enquiry Us"),
            subject: 'Enquiry',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.enquiry',
            with: [
                'email' => $this->email,
            ],
        );
    }

    // /**
    //  * Get the attachments for the message.
    //  *
    //  * @return array<int, \Illuminate\Mail\Mailables\Attachment>
    //  */
    public function attachments(): array
    {
        return [];
    }
}
