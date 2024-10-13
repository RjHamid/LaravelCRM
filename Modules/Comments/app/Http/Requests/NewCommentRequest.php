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
        ];
    }

    public function messages()
    {
        return [
            'description.required' => 'فیلد مورده نظر اجباری است',
            'description.min' => 'توضیحات مورده نظر باید  حداقل حتما دارای 3 حرف باشد ',
            'description.max' => 'توضیحات مورده نظر باید  حداکثر حتما دارای 250 حرف باشد ',
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
