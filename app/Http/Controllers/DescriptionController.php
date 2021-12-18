<?php

namespace App\Http\Controllers;

use App\Models\Description;
use Illuminate\Http\Request;

class DescriptionController extends Controller
{
    public function showDescription()
    {
        $desc = Description::first();//return a model
        return response()->json(['message' => $desc->description]);
    }
}
