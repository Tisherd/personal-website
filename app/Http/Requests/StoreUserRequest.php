<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'login' => 'required|unique:users,login',
            'password' => 'required|min:6',
            'role_id' => 'required|exists:user_roles,id',
            'desc' => 'nullable|string',
        ];
    }
}
