<?php

namespace App\Notifications;

use App\Submission;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;

class KKApprovedNotification extends Notification
{
    use Queueable;

    /**
     * @var Submission
     */
    protected $submission;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($submission)
    {
        $this->submission = $submission;
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
            ->subject('Kartu Keluarga Baru')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->attach(Storage::path($this->submission->attachment->foto_kk_baru), [
                'as' => 'KK-Baru-'.$this->submission->id.'.pdf',
                'mime' => 'application/pdf'
            ])
            ->markdown('mails.kk_approved', [
                'user' => $this->submission->user,
                'submission' => $this->submission
            ]);
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
