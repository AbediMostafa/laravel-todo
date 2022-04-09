<?php

namespace AbediMostafa\ToDo\http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddLabelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'label'=>'required|unique:labels|max:255'
        ];
    }
}
