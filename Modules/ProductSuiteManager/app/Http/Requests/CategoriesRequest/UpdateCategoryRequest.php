<?php

namespace Modules\ProductSuiteManager\Http\Requests\CategoriesRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'parent_id' => ['nullable' , 'numeric' ,'exists:categories,id'],
            'title' => ['nullable' ,'min:2' , 'max:70'],
            'type' => ['nullable' ,'min:2' ,'max:70']
        ];
    }

    public function messages()
    {
        return [
            'parent_id.numeric' =>'مقدار حتما باید به عدد باشد',
            'parent_id.exists' =>'مقدار ارسال شده معتبر نیست',
            'title.min' => 'عنوان مورده نظر باید  حداقل حتما دارای 2 حرف باشد ' ,
            'title.max' => 'عنوان مورده نظر باید حداکثر حتما دارای 70 حرف باشد ' ,
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
