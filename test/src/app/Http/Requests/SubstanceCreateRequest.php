<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubstanceCreateRequest extends FormRequest
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
            'substance_name' => 'required|min:3|not_in:' . implode(',' ,\App\Models\Substance::select('name')->pluck('name')->toArray()),
            'visible' => 'nullable',
        ];
    }
}
