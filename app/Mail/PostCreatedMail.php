<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PostCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $post, $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($post, $user)
    {
        $this->post = $post;
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address('example@example.com', 'Admin'),
            subject: 'New Post Created!',
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
            view: 'emails.new-post',
            with: [
                'name' => $this->user->name,
                'title' => $this->post->title,
            ],
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
