<?php

namespace App\Notifications;

use App\Submission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class KKRejectedNotification extends Notification
{
    use Queueable;

    /**
     * @var Submission
     */
    protected $submission;
    protected $reject_reason;

    /**
     *
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($submission, $reject_reason)
    {
        $this->submission = $submission;
        $this->reject_reason = $reject_reason;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
            ->subject('Status Pengajuan Kartu Keluarga')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->line('Maaf pengajuan pembaruan KK yang anda buat pada tanggal '. $this->submission->created_at->format('d-m-Y'))
            ->line('__TIDAK DAPAT DIPROSES__')
            ->line('Dengan alasan:')
            ->line('_'.$this->reject_reason.'_')
            ->salutation('Terima Kasih');
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
            //
        ];
    }
}
