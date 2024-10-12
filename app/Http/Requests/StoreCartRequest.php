<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCartRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id', // کاربر باید وجود داشته باشد  
            'product_id' => 'required|exists:products,id', // محصول باید وجود داشته باشد  
            'unique_code' => 'required|string|unique:carts,unique_code', // کد منحصر به فرد باید یکتا باشد  
            'count' => 'required|integer|min:1', // تعداد باید یک عدد صحیح بزرگتر یا مساوی ۱ باشد  
            'price_unit' => 'required|integer|min:0', // قیمت واحد باید عددی بزرگتر یا مساوی ۰ باشد  
            'status' => 'required|string|max:255', // وضعیت باید یک رشته باشد  
        ];
    }
}
