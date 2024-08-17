<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,'.auth()->guard('admin')->user()->id,
            'phone' => 'required|unique:admins,phone,'.auth()->guard('admin')->user()->id,
            'country' => 'required|exists:countries,id',
            'city' => 'required|exists:cities,id',
            'address' => 'required',
            'password' => 'sometimes|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:200048',
        ];
    }
}
