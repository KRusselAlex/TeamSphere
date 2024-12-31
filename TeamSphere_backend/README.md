
# TeamSphere - Backend API

**French**: Gestion de présence et de permissions des employés  
**English**: Management of employee attendance and permissions

This is the backend API for the **TeamSphere** project, a system for managing employee attendance and permission requests. Built with Laravel, the API provides endpoints to handle user authentication, attendance tracking, permission requests, and user management.

## Features

- **User Authentication**: Login, registration, Email veriifcation and authentication via API tokens using Laravel Sanctum.
- **Attendance Management**: Employees can log their attendance, and administrators can view attendance records.
- **Permission Management**: Employees can request time off, which can be reviewed and approved by managers.
- **Role-based Access Control**: Different roles (admin, employee) with different levels of access.
- **Notification System**: When a permission request is granted or denied, the employee receives a notification via Laravel's notification system.

## Technologies Used

- **Backend Framework**: Laravel 11.x
- **Authentication**: Laravel Breeze for API authentication
- **Database**: MySQL 
- **Notifications**: Laravel Notification system 
- **API**: RESTful API design

## Prerequisites

Before setting up the API, ensure you have the following installed:

- PHP >= 8.0
- Composer
- MySQL 
- Laravel 11.x

## Installation

### 1. Clone the Repository

```bash
git clone git@github.com:KRusselAlex/TeamSphere.git 
cd TeamSphere_Backend
```

### 2. Install Dependencies

Run the following command to install all PHP dependencies:

```bash
composer install
```

### 3. Set Up Environment File

Copy the example environment file and configure it for your local environment:

```bash
cp .env.example .env
```

Update the `.env` file with your database credentials and other settings (e.g., app name, mail configuration, etc.).

### 4. Migrate the Database

Create the necessary database tables by running the migrations:

```bash
php artisan migrate
```

This will create the default tables for users, roles, presence, and permissions.

### 5. Set Up API Routes

The routes for the API are located in `routes/api.php`. You can add additional routes for your features as necessary. By default, routes for authentication, presence, and permissions are included.

### 6. Test the API

Run the following command to start the Laravel development server:

```bash
php artisan serve
```

The API should now be accessible at `http://localhost:8000`.

### 7. API Authentication

To use the API, you need to authenticate by obtaining an access token via the `/api/v1/auth/login` endpoint (or `/api/v1/auth/register` for new users). Use Laravel Sanctum flow for API tokens.

## API Endpoints

Here are the key API endpoints for TeamSphere:

### Authentication

- **POST** `/api/auth/login`  
  User login, returns an API token.

- **POST** `/api/auth/register`  
  User registration (admin only).

- **POST** `/api/auth/logout`  
  Log the user out by invalidating the API token.

- **POST** `/api/auth/forgot-password`  
   Ask for an email to change your password.

- **POST** `/api/auth/reset-password`  
   User change  password.

### Presence

- **POST** `/api/presence`  
  Employees log their attendance.

- **GET** `/api/presence`  
  Retrieve all attendance records.

- **GET** `/api/presence/{id}`  
  Retrieve a specific attendance record.

- **PUT** `/api/presence/{id}`  
  Update a specific attendance record.

- **DELETE** `/api/presence/{id}`  
  Delete a specific attendance record.

### Permissions

- **POST** `/api/permissions`  
  Request a permission (time off).

- **GET** `/api/permissions`  
  Retrieve all permission requests.

- **GET** `/api/permissions/{id}`  
  Retrieve details of a specific permission request.

- **PUT** `/api/permissions/{id}`  
  Approve or reject a permission request (admin).  
  **Note:** Notifications are automatically sent to the employee when their permission request is granted or denied.

### Users

- **GET** `/api/users`  
  Get a list of all users (admin only).

- **GET** `/api/users/{id}`  
  Get details of a specific user.

- **PUT** `/api/users/{id}`  
  Update a user’s profile (admin/manager).

- **DELETE** `/api/users/{id}`  
  Delete a user (admin).

## Notifications for Permission Requests

When a permission request is granted or denied, the system will automatically send a **notification** to the employee via the Laravel notification system.Modify the PermissionNotification.php to customise your notification email.



```php

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

```

## Contributing

If you would like to contribute to this project, follow these steps:

1. Fork the repository.
2. Create a new branch (`git checkout -b feature/your-feature`).
3. Make your changes and commit them (`git commit -am 'Add new feature'`).
4. Push to your branch (`git push origin feature/your-feature`).
5. Create a pull request.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Acknowledgments

- Laravel for the powerful backend framework.
- Laravel Notifications for real-time notifications.
- All contributors to this open-source project.
