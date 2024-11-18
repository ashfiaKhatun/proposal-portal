<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccountStatusNotification extends Notification
{
    use Queueable;

    protected $status;

    public function __construct($status)
    {
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $message = (new MailMessage)
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->subject('Account Status Update')
            ->line("Your account status has been updated to: {$this->status}.")
            ->action('Proposal Portal', url('/'));

        if ($this->status === 'approved') {
            $message->line('Your account has been approved. You can now log in to the system. http://127.0.0.1:8000/');
        } elseif ($this->status === 'rejected') {
            $message->line('Unfortunately, your account has been rejected.');
        }

        $message->line('Thank you for using our system!');

        return $message;
    }
}
