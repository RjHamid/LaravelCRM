<?php

namespace Modules\ProductSuiteManager\Http\Requests\ProductsRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'category_id' => ['nullable' ,'numeric','exists:categories,id'],
            'name' => ['nullable',  'min:2' , 'max:100'],
            'description' => ['nullable' , 'min:2' ,'max:240'],
            'price' => ['nullable','numeric' , 'gte:10000'],
            'quantity' => ['nullable','numeric','min:1'],
            'pic' => ['nullable','mimes:jpg,svg,jpeg,png,mpeg','min:5','max:5024']
        ];
    }

    public function messages()
    {
        return [
            'category_id.numeric' =>'مقدار حتما باید به عدد باشد',
            'category_id.exists' =>'مقدار ارسال شده معتبر نیست',

            'name.unique' => 'این اسم از قبل وجود دارد لطفا اسم دیگری وارد کنید ' ,
            'name.min' => 'اسم مورده نظر باید  حداقل حتما دارای 2 حرف باشد ' ,
            'name.max' => 'اسم مورده نظر باید حداکثر حتما دارای 100 حرف باشد ' ,

            'description.min' => 'توضیحات مورده نظر باید  حداقل حتما دارای 2 حرف باشد ',
            'description.max' => 'توضیحات مورده نظر باید حداکثر حتما دارای 240 حرف باشد ',

            'price.numeric' => 'فیلد مورده نظر باید به عدد و ریال باشید',
            'price.gt' => 'قیمت مورده نظر باید حداقل حتما بشتبر یا مساوی با  10000 (ریال) باشد ',

            'quantity.numeric' =>  'موجودی محصول مورده نظر باید به عدد  باشید' ,
            'quantity.min' =>  'موجودی محصول مورده نظر باید  حداقل حتما باید 1 محصول تو انبار ازش موجود باشد ' ,

            'pic.min' => 'عکس مورده نظر باید حداقل باید 5kb باشد ',
            'pic.max' => 'عکس مورده نظر باید حداکثر باید 5mb باشد ',
            'pic.mimes' => 'عکس مورده نظر باید فقط از نوع jpg,svg,jpeg,png,mpeg باشد ',
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
