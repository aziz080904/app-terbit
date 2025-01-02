<?php

namespace App\Notifications;

use App\Models\Jadwal;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class JadwalUpcomingNotification extends Notification
{
    use Queueable;

    protected $jadwal;

    public function __construct(Jadwal $jadwal)
    {
        $this->jadwal = $jadwal;
    }

    public function via($notifiable)
    {
        return ['database', 'mail']; // Channel notifikasi via database dan email
    }

    public function toDatabase($notifiable)
{
    return [
        'jadwal_id' => $this->jadwal->id,
        'message' => "Jadwal bimbingan: {$this->jadwal->judul} pada {$this->jadwal->waktu->format('d M Y H:i')}",
        'link' => route('jadwals.index'),
        'icon' => 'fas fa-calendar-alt',
    ];
}

    public function toMail($notifiable)
    {
        $waktu = $this->jadwal->waktu ? $this->jadwal->waktu->format('d M Y H:i') : 'Waktu tidak tersedia';

        return (new MailMessage)
                    ->subject('Pengingat Jadwal Bimbingan')
                    ->line("Jadwal: {$this->jadwal->judul}")
                    ->line('Waktu: ' . $waktu)
                    ->action('Lihat Jadwal', route('jadwals.index'))
                    ->line('Terima kasih telah menggunakan aplikasi kami!');
    }
}
