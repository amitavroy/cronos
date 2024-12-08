<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPasswordChangeRequest extends FormRequest
{
    /**
     * @return array<string, array<int, string>|string>
     */
    public function rules(): array
    {
        return [
            'password' => 'required|string|min:6|confirmed|different:current_password',
            'current_password' => 'required',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
