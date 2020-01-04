<?php

namespace App\Http\Controllers;

use App\Field;
use App\Http\Requests\SubscriberRequest;
use App\Http\Resources\SubscriberResource;
use App\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class SubscriberController extends Controller
{

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $subscribers = Subscriber::query()->paginate();

        return SubscriberResource::collection($subscribers);
    }

    /**
     * @param SubscriberRequest $request
     * @return SubscriberResource
     */
    public function store(SubscriberRequest $request)
    {
        $subscriber = Subscriber::query()->create($request->all());

        $sync = [];
        $fields = $request->get(Subscriber::REL_FIELDS, []);
        foreach ($fields as $field) {
            $sync[Field::findByTitle($field[Field::A_TITLE])->id] = [
                Field::PIVOT_VALUE => Arr::get($field, Field::PIVOT_VALUE, '')
            ];
        }
        $subscriber->{Subscriber::REL_FIELDS}()->sync($sync);

        return SubscriberResource::make($subscriber->fresh());
    }

    /**
     * @param Subscriber $subscriber
     * @return SubscriberResource
     */
    public function show(Subscriber $subscriber)
    {
        return SubscriberResource::make($subscriber);
    }

    /**
     * @param SubscriberRequest $request
     * @param Subscriber $subscriber
     * @return SubscriberResource
     */
    public function update(SubscriberRequest $request, Subscriber $subscriber)
    {
        $subscriber->update($request->all());

        $sync = [];
        $fields = $request->get(Subscriber::REL_FIELDS, []);
        foreach ($fields as $field) {
            $sync[Field::findByTitle($field[Field::A_TITLE])->id] = [
                Field::PIVOT_VALUE => Arr::get($field, Field::PIVOT_VALUE, '')
            ];
        }
        $subscriber->{Subscriber::REL_FIELDS}()->sync($sync);

        return SubscriberResource::make($subscriber->fresh());
    }

    /**
     * @param Subscriber $subscriber
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Subscriber $subscriber)
    {
        $success = $subscriber->delete();

        return $this->response($success);
    }
}
