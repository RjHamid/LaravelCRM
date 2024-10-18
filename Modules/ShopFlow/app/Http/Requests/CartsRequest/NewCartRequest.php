<?php

namespace Modules\ShopFlow\Http\Requests\CartsRequest;

use Illuminate\Foundation\Http\FormRequest;

class NewCartRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'count' => ['required' , 'numeric' , 'min:1']
        ];
    }

    public function messages()
    {
        return [
            'count.required' => 'فیلد مورده نظر اجباری است',
            'count.numeric' => 'تعداد باید به عدد باشد',
            'count.min' => 'تعداد مورده نطر حدافل حتما باید 1 باشد'
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
