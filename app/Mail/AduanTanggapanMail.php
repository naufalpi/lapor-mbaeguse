<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Aduan;
use App\Models\Tanggapan;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AduanTanggapanMail extends Mailable
{
    use Queueable, SerializesModels;

    public $aduan;
    public $tanggapan;

    /**
     * Create a new message instance.
     */
    public function __construct(Aduan $aduan, Tanggapan $tanggapan)
    {
        $this->aduan = $aduan;
        $this->tanggapan = $tanggapan;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Aduan ' . $this->aduan->nomor_tiket . ' Ditanggapi',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.aduan.tanggapan',
            with: [
                'aduan' => $this->aduan,
                'tanggapan' => $this->tanggapan,
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
