<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Komentar;

class KomentarAduanNotification extends Notification
{
    use Queueable;

    public $komentar;

    public function __construct(Komentar $komentar)
    {
        $this->komentar = $komentar;
    }

    public function via($notifiable)
    {
        return ['mail']; // 'database' wajib untuk masuk ke tabel notifications
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Komentar Baru Masuk')
                    ->greeting('Halo '.$notifiable->name)
                    ->line('Ada komentar baru di aduan: "'.$this->komentar->aduan->judul.'"')
                    ->action('Lihat Komentar', url('/admin/aduan/'.$this->komentar->aduan_id))
                    ->line('Terima kasih telah menggunakan aplikasi Lapor!');
    }

 
}
