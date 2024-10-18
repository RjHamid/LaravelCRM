<?php

namespace Modules\ShopFlow\Http\Requests\CartsRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCartRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'count' => ['nullable' , 'numeric' , 'min:1']
        ];
    }


    public function messages()
    {
        return [
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
