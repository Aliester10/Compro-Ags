<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SpecialistContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Data dari formulir kontak
     * 
     * @var array
     */
    public $data;

    /**
     * Create a new message instance.
     * 
     * @param array $data Data dari formulir kontak
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pesan dari Pelanggan: ' . $this->data['fullName'],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'Member.profile.specialist-contact',
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