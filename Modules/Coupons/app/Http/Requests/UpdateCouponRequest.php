<?php

namespace Modules\Coupons\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCouponRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'percent' => ['nullable' , 'min:1' , 'max:100'],
            'max_amount' => ['nullable' , 'min:10000' , 'numeric' ],
            'max_usage' => ['nullable' , 'min:1' , 'numeric'],
            'started_at' => ['nullable' ,'data' , 'before:expire_at'],
            'expire_at' => ['nullable' ,'data' , 'after:started_at']
        ];
    }

    public function messages()
    {
        return [
            'percent.numeric' =>  'درصد مورده نظر باید به عدد  باشید' ,
            'percent.min' =>  'درصد مورده نظر باید  حداقل حتما باید 1 درصد باشد ' ,
            'percent.max' =>  'درصد مورده نظر باید  حداکثر حتما باید 100  باشد ' ,

            'max_amount.numeric' =>  'مقدار مورده نظر باید به عدد  باشید' ,
            'max_amount.min' =>  'مقدار مورده نظر باید  حداقل حتما باید (ریال)10000 باشد ' ,

            'max_usage.numeric' =>  'مقدار مورده نظر باید به عدد  باشید' ,
            'max_usage.min' =>  'مقدار مورده نظر باید  حداقل حتما باید 1 باشد ' ,

            'started_at.date' =>  'مقدار مورده نظر باید به تاریخ  باشید' ,
            'started_at.before' =>  'تاریخ مورده نظر باید   حتما قبل از تاریخ انقظا باشد ' ,

            'expire_at.date' =>  'مقدار مورده نظر باید به تاریخ  باشید' ,
            'expire_at.after' =>  'تاریخ مورده نظر باید   حتما بعد از تاریخ شروع باشد ' ,
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
