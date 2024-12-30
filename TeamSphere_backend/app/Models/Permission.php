<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Permission extends Model
{
     /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'permission_type',
        'start_date',
        'end_date',
        'reason',
        'justification',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // If you want to access the user directly from a presence
    public function getUserNameAttribute()
    {
        return $this->user->name ?? 'No user';
    }

}
