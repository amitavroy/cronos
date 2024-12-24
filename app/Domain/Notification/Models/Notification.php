<?php

namespace App\Domain\Notification\Models;

use App\Models\User;
use Database\Factories\NotificationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Notification extends Model
{
    /** @use HasFactory<NotificationFactory> */
    use HasFactory;

    protected $fillable = ['title', 'message'];

    /**
     * Get users that have read the notification
     *
     * @return BelongsToMany<User, covariant $this>
     */
    public function readByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_notification')
            ->withPivot('read_at')
            ->withTimestamps();
    }
}
