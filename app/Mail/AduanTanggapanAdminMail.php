<?php

namespace App\Mail;

use App\Models\Aduan;
use App\Models\Tanggapan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AduanTanggapanAdminMail extends Mailable
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

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tanggapan Baru untuk Aduan #' . $this->aduan->nomor_tiket,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.aduan.tanggapan-admin',
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
