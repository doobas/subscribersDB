<?php

namespace App\Http\Controllers;

use App\Field;

class FieldTypeController extends Controller
{
    public function index()
    {
        return response()->json(Field::TYPES);
    }
}
