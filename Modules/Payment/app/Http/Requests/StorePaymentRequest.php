<?php

namespace Modules\Payment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
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
    public function messages(): array  
{  
    return [  
        'order_id.required' => 'شناسه سفارش الزامی است.',  
        'order_id.exists' => 'شناسه سفارش انتخاب شده وجود ندارد.',  
        
        'tracking_code.required' => 'کد ردیابی الزامی است.',  
        'tracking_code.string' => 'کد ردیابی باید یک رشته باشد.',  
        'tracking_code.max' => 'کد ردیابی نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',  
        
        'card_pin.required' => 'پین کارت الزامی است.',  
        'card_pin.string' => 'پین کارت باید یک رشته باشد.',  
        'card_pin.max' => 'پین کارت نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',  
        
        'total_price.required' => 'قیمت کل الزامی است.',  
        'total_price.integer' => 'قیمت کل باید یک عدد صحیح باشد.',  
        'total_price.min' => 'قیمت کل نمی‌تواند منفی باشد.',  
        
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
