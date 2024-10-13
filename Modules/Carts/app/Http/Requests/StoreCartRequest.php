<?php

namespace Modules\Carts\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCartRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
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

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    public function messages(): array  
{  
    return [  
        'user_id.required' => 'کاربر الزامی است.',  
        'user_id.exists' => 'کاربر انتخاب شده وجود ندارد.',  
        
        'product_id.required' => 'محصول الزامی است.',  
        'product_id.exists' => 'محصول انتخاب شده وجود ندارد.',  
        
        'unique_code.required' => 'کد منحصر به فرد الزامی است.',  
        'unique_code.string' => 'کد منحصر به فرد باید یک رشته باشد.',  
        'unique_code.unique' => 'این کد منحصر به فرد قبلاً ثبت شده است.',  
        
        'count.required' => 'تعداد الزامی است.',  
        'count.integer' => 'تعداد باید یک عدد صحیح باشد.',  
        'count.min' => 'تعداد باید حداقل ۱ باشد.',  
        
        'price_unit.required' => 'قیمت واحد الزامی است.',  
        'price_unit.integer' => 'قیمت واحد باید یک عدد صحیح باشد.',  
        'price_unit.min' => 'قیمت واحد نمی‌تواند منفی باشد.',  
        
        'status.required' => 'وضعیت الزامی است.',  
        'status.string' => 'وضعیت باید یک رشته باشد.',  
        'status.max' => 'وضعیت نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',  
    ];  
} 
}
