<?php

namespace App\Models;

use App\Domain\Notification\Models\Notification;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'position',
        'country',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get orders for a user
     *
     * @return HasMany<Order, covariant $this>
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get notifications read by a user
     *
     * @return BelongsToMany<Notification, covariant $this>
     */
    public function readNotifications(): BelongsToMany
    {
        return $this->belongsToMany(Notification::class, 'user_notification')
            ->withPivot('read_at')
            ->withTimestamps();
    }

    /**
     * @return HasOne<UserProfile, covariant $this>
     */
    public function profile(): HasOne
    {
        return $this->hasOne(UserProfile::class);
    }
}
