<?php

namespace Modules\Order\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [  
            'unique_code' => 'sometimes|required|string|unique:orders,unique_code,' . $this->route('id'), // کد منحصر به فرد باید یکتا باشد  
            'address_id' => 'sometimes|required|exists:addresses,id', // آدرس باید وجود داشته باشد  
            'gate' => 'sometimes|required|string|max:255', // درب باید یک رشته باشد  
            'price_total' => 'sometimes|required|integer|min:0', // قیمت کل باید عددی بزرگتر یا مساوی ۰ باشد  
            'transaction_id' => 'nullable|string|max:255', // شناسه تراکنش می‌تواند خالی باشد  
            'status' => 'sometimes|required|string|max:255', // وضعیت باید یک رشته باشد  
        ];
    }
    public function messages(): array  
    {  
        return [  
            'unique_code.required' => 'کد منحصر به فرد الزامی است.',  
            'unique_code.string' => 'کد منحصر به فرد باید یک رشته باشد.',  
            'unique_code.unique' => 'این کد منحصر به فرد قبلاً ثبت شده است.',  
            
            'address_id.required' => 'آدرس الزامی است.',  
            'address_id.exists' => 'آدرس انتخاب شده وجود ندارد.',  
            
            'gate.required' => 'درب الزامی است.',  
            'gate.string' => 'درب باید یک رشته باشد.',  
            'gate.max' => 'درب نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',  
            
            'price_total.required' => 'قیمت کل الزامی است.',  
            'price_total.integer' => 'قیمت کل باید یک عدد صحیح باشد.',  
            'price_total.min' => 'قیمت کل نمی‌تواند منفی باشد.',  
            
            'transaction_id.string' => 'شناسه تراکنش باید یک رشته باشد.',  
            'transaction_id.max' => 'شناسه تراکنش نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',  
            
            'status.required' => 'وضعیت الزامی است.',  
            'status.string' => 'وضعیت باید یک رشته باشد.',  
            'status.max' => 'وضعیت نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',  
        ];  
    }
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
