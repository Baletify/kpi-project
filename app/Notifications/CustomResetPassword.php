<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomResetPassword extends Notification implements ShouldQueue
{
    use Queueable;



    /**
     * Create a new notification instance.
     */
    protected $token;

    public function __construct($token)
    {
        $this->token = $token;
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
    public function toMail(object $notifiable): MailMessage
    {
        $url = url(route('reset-password-token', ['token' => $this->token], false));

        return (new MailMessage)
            ->subject('Reset Password Aplikasi KPI') // Custom subject
            ->greeting('Halo!') // Custom greeting
            ->line('Ini adalah email otomatis dari aplikasi KPI.') // Custom message
            ->line('Silahkan klik tombol di bawah ini untuk melakukan reset password.') // Custom instruction
            ->action('Reset Password', $url) // Reset password button
            ->line('Link ini berlaku selama 60 menit. Jika Anda tidak meminta reset password, abaikan email ini.') // Expiry notice
            ->salutation('Terima kasih, Aplikasi KPI'); // Custom salutation
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
