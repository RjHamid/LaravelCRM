<?php

namespace Modules\ShopFlow\Http\Requests\OrdersRequest;

use Illuminate\Foundation\Http\FormRequest;

class NewOrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'address_id' => ['required' , 'exists:addresses,id'],
            'gate' => ['required' ,'in:payir']
        ];
    }

    public function messages()
    {
        return [
            'gate.required' => 'فیلد مورده نظر اجباری است ',
            'gate.in' => 'مقادیر ارسال شده باید payir و غیره باشد',
            'address_id.required' => 'فیلد مورده نظر اجباری است ',
            'address_id.exists' => 'مقادیر ارسال شده معتبر نیست'
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
