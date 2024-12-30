<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PermissionNotification extends Notification
{
    use Queueable;
    protected $status;
    protected $permission_type;
    protected $employee_name;
    protected $admin_name;


    /**
     * Create a new notification instance.
     */
    public function __construct($status, $permission_type, $employee_name, $admin_name)
    {
        switch ($permission_type) {
            case 'sick':
                $this->permission_type = 'maladie';
                break;
            case 'vacation':
                $this->permission_type = 'voyage';
                break;
            default:
                $this->permission_type = 'personnelle';
                break;
        }


        switch ($status) {
            case 'approved':
                $this->status = 'approuvé';
                break;
            default:
                $this->status = 'rejeté';
                break;
        }
        $this->employee_name = $employee_name;
        $this->admin_name = $admin_name;
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
        return (new MailMessage)
            ->subject('Objet : Réponse à votre demande de permission')
            ->greeting('Monsieur/Madame, ' .  $this->employee_name)
            ->line("Suite à votre demande de permission de type {$this->permission_type}, nous avons pris en compte votre requête. Après examen, nous vous informons que votre demande a été {$this->status}.")
            // ->action('View Details', url('/'))
            ->line('Cordialement,')
            ->line($this->admin_name);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable)
    {
        return [
            'employee_name' => $this->employee_name,
            'status' => $this->status,
            'permission_type' => $this->permission_type,
        ];
    }
}
