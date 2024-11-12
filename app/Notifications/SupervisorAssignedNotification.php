<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SupervisorAssignedNotification extends Notification
{
    use Queueable;

    protected $proposalTitle;
    protected $studentName;

    public function __construct($proposalTitle, $studentName)
    {
        $this->proposalTitle = $proposalTitle;
        $this->studentName = $studentName;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->subject('New Proposal Assignment')
            ->line("You have been assigned as the supervisor for the proposal titled '{$this->proposalTitle}'.")
            ->line("The proposal was submitted by {$this->studentName}.")
            ->line('Please review the proposal and provide feedback if necessary. http://127.0.0.1:8000/')
            ->line('Thank you for your guidance and support!');
    }
}
