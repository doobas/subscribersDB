<?php

namespace App\Http\Requests;

use App\Field;
use App\Rules\FieldValue;
use App\Subscriber;
use Illuminate\Validation\Rule;

class SubscriberRequest extends FormRequest
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
            Subscriber::A_NAME => ['required'],
            Subscriber::A_EMAIL => [
                'required',
                'email',
                Rule::unique(Subscriber::TABLE)->ignore($this->getSubscriberId())
            ],
            Subscriber::REL_FIELDS => [
                'nullable',
                'array'
            ],
            Subscriber::REL_FIELDS . '.*.' . Field::A_TITLE => [
                'required',
                'exists:' . Field::TABLE . ',' . Field::A_TITLE
            ],
            Subscriber::REL_FIELDS . '.*.' . Field::PIVOT_VALUE => [
                'nullable',
                new FieldValue($this->validationData())
            ],
        ];
    }

    private function getSubscriberId()
    {
        $subscriberId = $this->route('subscriber');
        if ($subscriberId instanceof Subscriber) {
            $subscriberId = $subscriberId->id;
        }
        return $subscriberId;
    }

    public function attributes()
    {
        return [
            Subscriber::REL_FIELDS . '.*.' . Field::A_TITLE => Field::A_TITLE,
            Subscriber::REL_FIELDS . '.*.' . Field::PIVOT_VALUE => Field::PIVOT_VALUE,
        ];
    }
}
