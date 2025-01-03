<?php

namespace App\Http\Requests;

use App\Enum\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SegmentRequest extends FormRequest
{
    /**
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'description' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return Auth::user()?->role === UserRole::ADMIN->value;
    }
}
