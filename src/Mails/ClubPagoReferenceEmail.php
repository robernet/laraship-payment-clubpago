<?php

namespace Corals\Modules\Payment\ClubPago\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ClubPagoReferenceEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly string $order_number,
        public readonly float $amount,
        public readonly string $payment_reference,
        public readonly string $pay_format,
        public readonly string $folio,
        public readonly string $fecha,
        public readonly ?string $emailSubject = null,
        public readonly ?string $body = null,
        public readonly array $options = [],
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->emailSubject ?? trans('ClubPago::labels.mail.payment_reference'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'ClubPago::mails.clubpago_reference',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
