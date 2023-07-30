<?php

namespace App\Notifications\Payment;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PembayaranNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $pembayaran;
    public function __construct($pembayaran)
    {
        $this->pembayaran = json_decode($pembayaran);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'order_id' => $this->pembayaran->order_id,
            'user_email' => $this->pembayaran->email_pemesan->email, // pengirim notif
            'pembayaran_id' => $this->pembayaran->id,
            'title' => 'Pembayaran Tagihan',
            'messages' => $this->pembayaran->email_pemesan->nama_depan . ' ' . $this->pembayaran->email_pemesan->nama_belakang . ' melakukan pembayaran' . ($this->pembayaran->jenis_pembayaran === 'dp' ? ' Uang Muka' : '') . '.',
            'url' => route('manage-pesanan-proses.detail', $this->pembayaran->id),
        ];
    }
}
