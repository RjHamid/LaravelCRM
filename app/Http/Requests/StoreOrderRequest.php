<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'unique_code' => 'required|string|unique:orders,unique_code', // کد منحصر به فرد باید یکتا باشد  
            'address_id' => 'required|exists:addresses,id', // آدرس باید وجود داشته باشد  
            'gate' => 'required|string|max:255', // درب باید یک رشته باشد  
            'price_total' => 'required|integer|min:0', // قیمت کل باید عددی بزرگتر یا مساوی ۰ باشد  
            'transaction_id' => 'nullable|string|max:255', // شناسه تراکنش می‌تواند خالی باشد  
            'status' => 'required|string|max:255', // وضعیت باید یک رشته باشد  
        ];
    }
}
