<?php

namespace App\Rules;

use App\Field;
use App\Subscriber;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class FieldValue implements Rule
{
    private $data;

    private $messages = 'The :attribute must be a valid value';

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $index = Arr::get(explode('.', $attribute), 1);
        if (is_null($index)) {
            return false;
        }

        $title = Arr::get($this->data, Subscriber::REL_FIELDS.'.'.$index.'.'.Field::A_TITLE);
        if (is_null($title)) {
            return false;
        }

        $field = Field::findByTitle($title);
        if (!$field) {
            return false;
        }

        $rule = Arr::get(Field::TYPE_VALIDATION, $field->{Field::A_TYPE});
        if (is_null($rule)) {
            return false;
        }

        $validator = Validator::make(['field_value' => $value], [
            'field_value' => $rule
        ]);

        if ($validator->fails()) {
            $this->messages = $validator->errors()->get('field_value');
        }

        return !$validator->fails();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->messages;
    }
}
