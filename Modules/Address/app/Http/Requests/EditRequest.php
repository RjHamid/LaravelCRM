<?php

namespace Modules\Address\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
          return [  
       'user_id' => 'required|exists:users,id', // اطمینان حاصل می‌کند که user_id موجود است  
        'description' => 'required|string|max:255', // توصیف باید رشته‌ای و حداکثر 255 کاراکتر باشد  
     ];  
    } 
    
        public function messages()  
        {  
            return [  
                'user_id.required' => 'شناسه کاربر الزامی است.',  
                'user_id.exists' => 'شناسه انتخاب شده برای کاربر وجود ندارد.',  
                'description.required' => 'توضیح الزامی است.',  
                'description.string' => 'توضیح باید یک رشته باشد.',  
                'description.max' => 'توضیح نباید بیشتر از 255 کاراکتر باشد.',  
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
