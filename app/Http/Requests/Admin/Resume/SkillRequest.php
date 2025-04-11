<?php

namespace App\Http\Requests\Admin\Resume;

use Illuminate\Foundation\Http\FormRequest;

class SkillRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:10000',
            'level' => 'required|integer|min:0|max:100',
            'sort' => 'required|integer|min:0',
            'skill_group_id' => 'required|exists:skill_groups,id',
        ];
    }
}
