<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class codeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()  
    {  
        return [  
            'phone' => 'nullable|string|regex:/^\d{11}$/',  
            'email' => 'nullable|email',  
        ];  
    }  

    public function messages()  
    {  
        return [  
            'phone.regex' => 'شماره تلفن باید 11 رقمی باشد.',  
            'email.email' => 'لطفاً یک آدرس ایمیل معتبر وارد کنید.',  
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
