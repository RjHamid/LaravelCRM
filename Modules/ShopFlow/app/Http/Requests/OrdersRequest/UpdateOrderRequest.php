<?php

namespace Modules\ShopFlow\Http\Requests\OrdersRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'status' => ['nullable' , 'in:failed,paid,pending'],
            'progress_id' => ['nullable' , 'exists:orders_progress,id']
        ];
    }

    public function messages()
    {
        return [
            'status.in' => 'مقادیر ارسال شده باید failed,paid,pending و غیره باشد',
            'progress_id.exists' => 'مقادیر ارسال شده معتبر نیست'
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
