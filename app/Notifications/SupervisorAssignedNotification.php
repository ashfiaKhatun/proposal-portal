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
    protected $recipientType;

    public function __construct($proposalTitle, $studentName, $recipientType)
    {
        $this->proposalTitle = $proposalTitle;
        $this->studentName = $studentName;
        $this->recipientType = $recipientType; // 'supervisor' or 'student'
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $mailMessage = new MailMessage;
        $mailMessage->from(config('mail.from.address'), config('mail.from.name'));

        if ($this->recipientType === 'supervisor') {
            $mailMessage->subject('New Proposal Assignment')
                ->greeting("Hello, {$notifiable->name}")
                ->line("You have been assigned as the supervisor for the proposal titled '{$this->proposalTitle}'.")
                ->line("The proposal was submitted by {$this->studentName}.")
                ->line('Please review the proposal and provide feedback if necessary.')
                ->action('Proposal Portal', url('/'))
                ->line('Thank you for your guidance and support!');
        } else if ($this->recipientType === 'student') {
            $mailMessage->subject('Supervisor Assigned to Your Proposal')
                ->greeting("Hello, {$notifiable->name}")
                ->line("Your proposal titled '{$this->proposalTitle}' has been assigned a supervisor.")
                ->line("Assigned Supervisor: {$this->studentName}")
                ->line('Please follow up with your supervisor for further guidance.')
                ->action('Proposal Portal', url('/'))
                ->line('Thank you for using our system!');
        }

        return $mailMessage;
    }
}
