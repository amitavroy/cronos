<?php

namespace App\Domain\Segment\Models;

use Database\Factories\SegmentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
    ];

    protected function casts(): array
    {
        return [
            'rules' => 'array',
        ];
    }
}
