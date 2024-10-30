<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'description',
        'completion_date',
        'is_complete',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'completion_date' => 'date',
            'is_complete' => 'boolean',
        ];
    }
}
