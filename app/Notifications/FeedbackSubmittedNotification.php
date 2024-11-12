<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FeedbackSubmittedNotification extends Notification
{
    use Queueable;

    protected $feedback;
    protected $proposal;

    public function __construct($feedback, $proposal)
    {
        $this->feedback = $feedback;
        $this->proposal = $proposal;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->subject('New Feedback on Your Proposal')
            ->greeting("Hello {$notifiable->name},")
            ->line("You have received new feedback on your proposal (Proposal Title: {$this->proposal->title}).")
            ->line("Feedback: {$this->feedback}")
            ->line('You can log in to the portal to view more details. http://127.0.0.1:8000/')
            ->line('Thank you for using our system!');
    }
}
