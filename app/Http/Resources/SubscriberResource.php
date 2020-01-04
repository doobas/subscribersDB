<?php

namespace App\Http\Resources;

use App\Subscriber;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            Subscriber::A_NAME => $this->{Subscriber::A_NAME},
            Subscriber::A_EMAIL => $this->{Subscriber::A_EMAIL},
            Subscriber::A_STATE => $this->{Subscriber::A_STATE},
            Subscriber::CREATED_AT => $this->{Subscriber::CREATED_AT},
            Subscriber::UPDATED_AT => $this->{Subscriber::UPDATED_AT},
            Subscriber::REL_FIELDS => FieldResource::collection($this->whenLoaded(Subscriber::REL_FIELDS)),
        ];
    }
}
