<?php

namespace App\Http\Requests\Project;

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
            'title' => 'required|string|max:255|unique:projects,title',
            'description' => 'nullable|string|max:10000',
            'github_url' => 'nullable|url:http,https',
            'live_url' => 'nullable|url:http,https',
        ];
    }
}
