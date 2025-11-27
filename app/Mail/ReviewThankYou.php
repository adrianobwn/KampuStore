<?php

namespace App\Mail;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReviewThankYou extends Mailable
{
    use Queueable, SerializesModels;

    public $review;
    public $product;
    public $reviewerName;

    /**
     * Create a new message instance.
     */
    public function __construct(Review $review, Product $product, string $reviewerName)
    {
        $this->review = $review;
        $this->product = $product;
        $this->reviewerName = $reviewerName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Terima Kasih atas Ulasan Anda - KampuStore',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.review-thank-you',
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
