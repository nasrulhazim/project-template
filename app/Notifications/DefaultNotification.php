<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DefaultNotification extends Notification
{
    use Queueable;

    /**
     * Subject of the notification.
     *
     * @var string
     */
    private $subject;

    /**
     * Message of the notification.
     *
     * @var string
     */
    private $message;

    /**
     * URL of the notification.
     *
     * @var string|null
     */
    private $url;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $subject, string $message, string $url = null)
    {
        $this->subject = $subject;
        $this->message = $message;
        $this->url = $url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return notification_drivers();
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->subject($this->getSubject())
            ->markdown('mail.notification', $this->getData());
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return $this->getData();
    }

    /**
     * Get the subject of the notification.
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * Get the message of the notification.
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Get the URL of the notification.
     *
     * @return string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * An array of data of the notification.
     */
    public function getData(): array
    {
        return [
            'subject' => $this->getSubject(),
            'message' => $this->getMessage(),
            'url' => $this->getUrl(),
        ];
    }
}
