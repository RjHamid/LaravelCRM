<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRatingRequest extends FormRequest
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
            'type' => 'sometimes|required|string|max:255', // نوع امتیاز باید یک رشته باشد  
            'date_id' => 'sometimes|required|integer', // شناسه تاریخ باید عددی باشد  
            'rate' => 'sometimes|required|integer|min:1|max:5', // امتیاز باید عددی بین ۱ تا ۵ باشد  
        ];  
    }
    public function messages(): array  
    {  
        return [  
            'type.required' => 'نوع امتیاز الزامی است.',  
            'date_id.required' => 'شناسه تاریخ الزامی است.',  
            'rate.required' => 'امتیاز الزامی است.',  
            'rate.min' => 'امتیاز باید حداقل ۱ باشد.',  
            'rate.max' => 'امتیاز باید حداکثر ۵ باشد.',  
        ];  
    }
}
