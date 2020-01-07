<?php

namespace App\Http\Requests;

use App\Field;
use Illuminate\Validation\Rule;

class FieldRequest extends FormRequest
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
        $rules[Field::A_TITLE] = ['required'];

        if ($this->method() === 'POST') {
            $rules[Field::A_TYPE] = [
                'required',
                Rule::in(Field::TYPES)
            ];
        }

        return $rules;
    }
}
