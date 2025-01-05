<?php

namespace App\Domain\Segment\Models;

use App\Models\User;
use Database\Factories\SegmentFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Segment extends Model
{
    /** @use HasFactory<SegmentFactory> */
    use HasFactory, SoftDeletes;

    protected static function newFactory(): SegmentFactory
    {
        return SegmentFactory::new();
    }

    protected $fillable = [
        'name',
        'description',
        'rules',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'rules' => 'json',
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    public function customers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'segment_customer')
            ->withPivot('user_id', 'segment_id', 'deleted_at');
    }
}
