<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'settings.meta_title' => 'required|string|max:255',
            'settings.meta_description' => 'required|string',
            'settings.meta_keywords' => 'required|string',
            'settings.theme' => 'required|string',
            'settings.layout' => 'required|string',
        ];
    }
}
