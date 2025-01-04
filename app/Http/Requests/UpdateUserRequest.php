<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'login' => 'required|unique:users,login,' . $this->user->id,
            'role_id' => 'required|exists:user_roles,id',
            'desc' => 'nullable|string',
        ];
    }
}
