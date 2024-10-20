<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class loginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()  
    {  
        return [  
        'identifier' => 'required|string', 
        'credential' => 'required|string', ];
    }  

    public function messages()  
    {  
        return [  
            'identifier.required' => 'لطفاً شناسه (نام، ایمیل یا شماره تلفن) را وارد کنید.',  
            'credential.required' => 'لطفاً اعتبار (رمز عبور یا کد) را وارد کنید.',  
            'identifier.string' => 'شناسه باید یک رشته باشد.',  
            'credential.string' => 'اعتبار باید یک رشته باشد.',  
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
