<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'login' => 'required|unique:users,login,' . $this->user->id,
            'name' => 'required|string',
            'role_id' => 'required|exists:user_roles,id',
            'desc' => 'nullable|string',
        ];
    }
}
