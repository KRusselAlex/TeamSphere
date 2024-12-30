<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Presence extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'status',
        'time',
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

    public function formattedTime()
    {
        return $this->time ? \Carbon\Carbon::parse($this->time)->format('H:i:s') : 'No time';
    }
}
