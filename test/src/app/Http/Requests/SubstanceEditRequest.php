<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubstanceEditRequest extends FormRequest
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
            'substance_name' => 'required|min:3',
            'visible' => 'nullable',
        ];
    }
}
