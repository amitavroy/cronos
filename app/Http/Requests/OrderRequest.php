<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'total_amount' => ['required', 'numeric'],
            'status' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return Auth::check();
    }
}