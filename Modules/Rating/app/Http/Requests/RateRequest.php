<?php

namespace Modules\Rating\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'rate' => ['required','in:0,1,2,3,4,5']
        ];
    }

    public function messages()
    {
        return [
            'rate.required' => ['فلید مورده نظر اجباری است'],
            'rate.in' => [' امتیازه مورده نظر اجباری است'],
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
