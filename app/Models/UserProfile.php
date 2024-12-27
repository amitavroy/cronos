<?php

namespace App\Models;

use Database\Factories\UserProfileFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProfile extends Model
{
    /** @use HasFactory<UserProfileFactory> */
    use HasFactory;

    protected $fillable = [
        'profile_pic', 'user_id',
    ];

    /**
     * @return Attribute<string, never>
     */
    protected function profilePic(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value): mixed => $value
                ? route('private-image', ['filename' => $value])
                : config('app.default_profile_pic')
        );
    }

    /**
     * @return BelongsTo<User, covariant $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
