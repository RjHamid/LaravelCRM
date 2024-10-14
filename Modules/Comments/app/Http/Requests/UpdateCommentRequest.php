<?php

namespace Modules\Comments\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCommentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'description' => ['nullable' , 'min:3' , 'max:250'],
            'type' => ['nullable' , 'min:1' , 'max:50','in:product,blog'],
        ];
    }

    public function messages()
    {
        return [
            'description.min' => 'توضیحات مورده نظر باید  حداقل حتما دارای 3 حرف باشد ',
            'description.max' => 'توضیحات مورده نظر باید  حداکثر حتما دارای 250 حرف باشد ',
            'type.min' => 'تایپ مورده نظر باید  حداقل حتما دارای 1  حرف باشد ',
            'type.max' => 'توضیحات مورده نظر باید  حداکثر حتما دارای 50 حرف باشد '
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
