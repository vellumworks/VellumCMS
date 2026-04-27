<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TeamInvitation extends Notification
{
    use Queueable;

    public function __construct(
        private string $token,
        private string $orgName,
        private string $invitedByName,
    ) {}

    public function via(): array
    {
        return ['mail'];
    }

    public function toMail(mixed $notifiable): MailMessage
    {
        $url = route('invitation.show', $this->token);

        return (new MailMessage)
            ->subject("You've been invited to join {$this->orgName} on VellumCMS")
            ->greeting("You've been invited!")
            ->line("{$this->invitedByName} has invited you to join **{$this->orgName}** on VellumCMS.")
            ->line('Click the button below to set up your account. This link expires in 7 days.')
            ->action('Accept Invitation', $url)
            ->line('If you weren\'t expecting this invitation, you can safely ignore this email.');
    }
}
