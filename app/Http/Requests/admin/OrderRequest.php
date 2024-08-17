<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:pending,approved,done,canceled',
            'price' => 'required|numeric|min:0',
            'taxes' => 'required|numeric|min:0',
            'commission' => 'required|numeric|min:0',
            'total_price' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,credit_card,paypal',
            'created_at' => 'required|date',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => __('The user is required.'),
            'user_id.exists' => __('The selected user does not exist.'),
            'status.required' => __('The status is required.'),
            'status.in' => __('The selected status is invalid.'),
            'price.required' => __('The price is required.'),
            'price.numeric' => __('The price must be a number.'),
            'price.min' => __('The price must be at least 0.'),
            'taxes.required' => __('The taxes are required.'),
            'taxes.numeric' => __('The taxes must be a number.'),
            'taxes.min' => __('The taxes must be at least 0.'),
            'commission.required' => __('The commission is required.'),
            'commission.numeric' => __('The commission must be a number.'),
            'commission.min' => __('The commission must be at least 0.'),
            'total_price.required' => __('The total price is required.'),
            'total_price.numeric' => __('The total price must be a number.'),
            'total_price.min' => __('The total price must be at least 0.'),
            'payment_method.required' => __('The payment method is required.'),
            'payment_method.in' => __('The selected payment method is invalid.'),
            'order_date.required' => __('The order date is required.'),
            'order_date.date' => __('The order date is not a valid date.'),
            'products.*.id.required' => __('Each product must have an ID.'),
            'products.*.id.exists' => __('The selected product does not exist.'),
            'products.*.quantity.required' => __('Each product must have a quantity.'),
            'products.*.quantity.integer' => __('Each product quantity must be an integer.'),
            'products.*.quantity.min' => __('Each product quantity must be at least 1.'),
        ];
    }
}
