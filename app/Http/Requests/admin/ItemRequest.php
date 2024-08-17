<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'main_image' => 'image|mimes:jpeg,png,jpg,gif|max:200048',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:200048',
            'price_after_offer' => 'nullable|numeric',
            'category_id' => 'required|exists:categories,id',
            'price_before_offer' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) {
                    $priceAfterOffer = $this->input('price_after_offer');
                    if (!empty($priceAfterOffer) && $value <= $priceAfterOffer) {
                        $fail(__('The :attribute must be greater than Price after offer.'));
                    }
                },
            ],
            'existing_images' => 'nullable|array',
            'existing_images.*' => 'string',
            'deleted_images' => 'nullable|array',
            'deleted_images.*' => 'string',
        ];
    }
}
