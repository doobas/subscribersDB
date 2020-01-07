<?php

namespace App\Http\Controllers;

use App\Field;
use App\Http\Requests\FieldRequest;
use App\Http\Resources\FieldResource;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $fields = Field::all();

        return FieldResource::collection($fields);
    }

    /**
     * @param FieldRequest $request
     * @return FieldResource
     */
    public function store(FieldRequest $request)
    {
        $field = Field::query()->create($request->all());

        return FieldResource::make($field);
    }

    /**
     * @param Field $field
     * @return FieldResource
     */
    public function show(Field $field)
    {
        return FieldResource::make($field);
    }

    /**
     * @param FieldRequest $request
     * @param Field $field
     * @return FieldResource
     */
    public function update(FieldRequest $request, Field $field)
    {
        $field->update([
            Field::A_TITLE => $request->get(Field::A_TITLE)
        ]);

        return FieldResource::make($field);
    }

    /**
     * @param Field $field
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Field $field)
    {
        $success = $field->delete();

        return $this->response($success);
    }
}
