<?php

namespace App\Http\Resources;

use App\Field;
use Illuminate\Http\Resources\Json\JsonResource;

class FieldResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            Field::A_TITLE => $this->{Field::A_TITLE},
            Field::A_TYPE => $this->{Field::A_TYPE},
            Field::PIVOT_VALUE => $this->whenPivotLoaded('field_subscriber', function () {
                return $this->pivot->{Field::PIVOT_VALUE};
            }),
            Field::CREATED_AT => $this->when(
                !optional($this->pivot)->{Field::PIVOT_VALUE},
                $this->{Field::CREATED_AT}->format('Y-m-d H:i:s')
            ),
            Field::UPDATED_AT => $this->when(
                !optional($this->pivot)->{Field::PIVOT_VALUE},
                $this->{Field::UPDATED_AT}->format('Y-m-d H:i:s')
            ),
            Field::REL_SUBSCRIBERS => SubscriberResource::collection($this->whenLoaded(Field::REL_SUBSCRIBERS))
        ];
    }
}
