<?php

namespace Modules\Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [  
            'user_id' => 'required|exists:users,id',  
            'category_id' => 'required|exists:categories,id',  
            'title' => 'required|string|max:255',  
            'description' => 'required|string',  
            'pic' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',  
        ];  
    }  

    public function messages()  
    {  
        return [  
            'user_id.required' => 'لطفاً شناسه کاربر را وارد کنید.',  
            'user_id.exists' => 'کاربر انتخاب شده وجود ندارد.',  
            'category_id.required' => 'لطفاً شناسه دسته‌بندی را وارد کنید.',  
            'category_id.exists' => 'دسته‌بندی انتخاب شده وجود ندارد.',  
            'title.required' => 'لطفاً عنوان بلاگ را وارد کنید.',  
            'title.string' => 'عنوان باید یک رشته باشد.',  
            'title.max' => 'عنوان نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',  
            'description.required' => 'لطفاً توضیحات بلاگ را وارد کنید.',  
            'description.string' => 'توضیحات باید یک رشته باشد.',  
            'pic.required' => 'لطفاً تصویر بلاگ را انتخاب کنید.',  
            'pic.image' => 'فایل انتخاب شده باید یک تصویر باشد.',  
            'pic.mimes' => 'فرمت تصویر باید یکی از فرمت‌های jpeg، png، jpg، یا gif باشد.',  
            'pic.max' => 'حجم تصویر نباید بیشتر از ۲ مگابایت باشد.',  
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
