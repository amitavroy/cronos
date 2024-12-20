<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    /** @use HasFactory<\Database\Factories\NotificationFactory> */
    use HasFactory;

    protected $fillable = ['title', 'message'];

    public function readByUsers()
    {
        return $this->belongsToMany(User::class, 'user_notifications')
            ->withPivot('read_at')
            ->withTimestamps();
    }
}
