<?php

namespace Modules\ProductSuiteManager\Http\Requests\ProductsRequest;

use Illuminate\Foundation\Http\FormRequest;

class ProductDiscountRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'percent' => ['required','numeric','min:0','max:100']
        ];
    }


    public function messages()
    {
        return [
            'percent.required' => 'فیلد مورده نظر اجباری است',
            'percent.numeric' => 'درصد مورده نظر باید به عدد باشد ',
            'percent.min' => 'درصد مورده نظر باید  حداقل 0  درصد  باشد ',
            'percent.max' => 'درصد مورده نظر باید حداکثر   100 درصد باشد ',

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
