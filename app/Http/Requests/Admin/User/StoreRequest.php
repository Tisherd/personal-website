<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'login' => 'required|unique:users,login',
            'name' => 'required|string',
            'password' => 'required|min:6',
            'role_id' => 'required|exists:user_roles,id',
            'desc' => 'nullable|string',
        ];
    }
}
