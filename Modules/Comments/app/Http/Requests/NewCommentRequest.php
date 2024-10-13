<?php

namespace Modules\Comments\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewCommentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
           'description' => ['required' , 'min:3' , 'max:250'],
//            'type' => ['required' , 'min:1' , 'max:50'],
        ];
    }

    public function messages()
    {
        return [
            'description.required' => 'فیلد مورده نظر اجباری است',
            'description.min' => 'توضیحات مورده نظر باید  حداقل حتما دارای 3 حرف باشد ',
            'description.max' => 'توضیحات مورده نظر باید  حداکثر حتما دارای 250 حرف باشد ',
            /*'type.required' => 'فیلد مورده نظر اجباری است',
            'type.min' => 'تایپ مورده نظر باید  حداقل حتما دارای 1  حرف باشد ',
            'type.max' => 'توضیحات مورده نظر باید  حداکثر حتما دارای 50 حرف باشد '*/
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
