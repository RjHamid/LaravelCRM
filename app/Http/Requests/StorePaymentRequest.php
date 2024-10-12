<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
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
            'order_id' => 'required|exists:orders,id', // شناسه سفارش باید وجود داشته باشد  
            'tracking_code' => 'required|string|max:255', // کد ردیابی باید یک رشته باشد  
            'card_pin' => 'required|string|max:255', // پین کارت باید یک رشته باشد  
            'total_price' => 'required|integer|min:0', // قیمت کل باید عددی بزرگتر یا مساوی ۰ باشد  
            'status' => 'required|string|max:255', // وضعیت باید یک رشته باشد  
        ]; 
    }
}
