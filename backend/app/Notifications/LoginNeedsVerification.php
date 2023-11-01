<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\VonageMessage;
use Illuminate\Notifications\Notification;

class LoginNeedsVerification extends Notification
{
    use Queueable;
    public function __construct()
    {
        //
    }

    public function via($notifiable): array
    {
        return ['vonage'];
    }

    public function toVonage($notifiable): VonageMessage
    {
        $loginCode = rand(111111, 999999,);

        $notifiable->update([
            'login_code' => $loginCode
        ]);


        return (new VonageMessage())
            ->content("Your verification code is {$loginCode}");
    }

    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }

}
