<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentRequest extends FormRequest
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
            'tracking_code' => 'sometimes|required|string|max:255', // کد ردیابی باید یک رشته باشد  
            'card_pin' => 'sometimes|required|string|max:255', // پین کارت باید یک رشته باشد  
            'total_price' => 'sometimes|required|integer|min:0', // قیمت کل باید عددی بزرگتر یا مساوی ۰ باشد  
            'status' => 'sometimes|required|string|max:255', // وضعیت باید یک رشته باشد  
        ];
    }
}
