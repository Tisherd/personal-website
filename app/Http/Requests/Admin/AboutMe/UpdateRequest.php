<?php

namespace App\Http\Requests\Admin\AboutMe;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'photo' => 'nullable|image|max:2048',
            'full_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'description' => 'required|string',

            // 'contacts.email' => 'nullable|email',
            // 'contacts.telegram' => 'nullable|string|max:255',
        ];
    }
}
