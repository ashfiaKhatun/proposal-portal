<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProposalStatusNotification extends Notification
{
    use Queueable;

    protected $status;
    protected $proposalTitle;

    public function __construct($status, $proposalTitle)
    {
        $this->status = $status;
        $this->proposalTitle = $proposalTitle;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $message = (new MailMessage)
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->subject('Proposal Status Update')
            ->line("Your proposal titled '{$this->proposalTitle}' has been updated to: {$this->status}.");

        if ($this->status === 'approved') {
            $message->line('Your proposal has been approved. You may proceed as instructed. http://127.0.0.1:8000/');
        } elseif ($this->status === 'rejected') {
            $message->line('Unfortunately, your proposal has been rejected.');
        }

        $message->line('Thank you for using our system!');

        return $message;
    }
}
