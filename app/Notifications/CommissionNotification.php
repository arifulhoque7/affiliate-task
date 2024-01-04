<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CommissionNotification extends Notification
{
    use Queueable;
    protected $commission;
    /**
     * Create a new notification instance.
     */
    public function __construct($commission)
    {
        $this->commission = $commission;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $amount = $this->commission->amount;
        $commissionAmount = $this->commission->commission;

        return (new MailMessage)
            ->subject('Commission Notification')
            ->line('You have received a commission of $' . $commissionAmount . ' for a transaction of $' . $amount . '.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
