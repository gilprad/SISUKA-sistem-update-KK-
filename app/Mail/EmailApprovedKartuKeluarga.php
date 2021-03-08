<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailApprovedKartuKeluarga extends Mailable
{
    use Queueable, SerializesModels;

    protected $submission;

    /**
     * Create a new message instance.
     *
     * @param $submission
     */
    public function __construct($submission)
    {
        $this->submission = $submission;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->subject('Kartu Keluarga Baru')
            ->attachFromStorage($this->submission->attachment->foto_kk_baru, 'KK-Baru-'. $this->submission->id.'.pdf')
            ->view('mails.kk_baru', [
                'user' => $this->submission->user,
                'submission' => $this->submission
            ]);
    }
}
