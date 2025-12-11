<?php

namespace App\Mail;

use App\Models\Review;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReviewConfirmation extends Mailable
{
    use SerializesModels;

    public $review;
    public $productName;
    public $reviewerName;

    /**
     * Create a new message instance.
     */
    public function __construct(Review $review, string $productName, string $reviewerName)
    {
        $this->review = $review;
        $this->productName = $productName;
        $this->reviewerName = $reviewerName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Terima Kasih Atas Ulasan Anda - KampuStore',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.review-confirmation',
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
