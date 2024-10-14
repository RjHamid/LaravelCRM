<?php

namespace Modules\ProductSuiteManager\Http\Requests\CategoriesRequest;

use Illuminate\Foundation\Http\FormRequest;

class NewCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'parent_id' => ['nullable' , 'numeric' ,'exists:categories,id'],
            'title' => ['required' ,'unique:categories,title' ,'min:2' , 'max:70'],
            'type' => ['required' ,'min:2' ,'max:70','in:product,blog']
        ];
    }


    public function messages()
    {
        return [
            'parent_id.numeric' =>'مقدار حتما باید به عدد باشد',
            'parent_id.exists' =>'مقدار ارسال شده معتبر نیست',
            'title.required' => 'فیلد مورده نظر اجباری است' ,
            'title.unique' => 'این عنوان از قبل وجود دارد لطفا عنوان دیگری وارد کنید ' ,
            'title.min' => 'عنوان مورده نظر باید  حداقل حتما دارای 2 حرف باشد ' ,
            'title.max' => 'عنوان مورده نظر باید حداکثر حتما دارای 70 حرف باشد ' ,
            'type.required' => 'فیلد مورده نظر اجباری است',
            'type.min' => 'عنوان مورده نظر باید  حداقل حتما دارای 2 حرف باشد ',
            'type.max' => 'عنوان مورده نظر باید حداکثر حتما دارای 70 حرف باشد ',

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
