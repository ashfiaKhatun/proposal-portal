<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminAssignedNotification extends Notification
{
    use Queueable;

    protected $departmentName;
    protected $adminName;

    public function __construct($departmentName, $adminName)
    {
        $this->departmentName = $departmentName;
        $this->adminName = $adminName;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->subject('Admin Role Assigned')
            ->greeting("Hello {$this->adminName},")
            ->line("You have been assigned as the admin for the {$this->departmentName} department.")
            ->line('You can now log in and start managing your department.')
            ->action('Proposal Portal', url('/'))
            ->line('Thank you for being a part of our team!');
    }
}
