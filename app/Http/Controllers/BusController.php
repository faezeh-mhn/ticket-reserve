<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusRequest;
use App\Interfaces\BusRepo;
use App\Models\Bus;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BusController extends Controller
{
    public $busRepo;

    public function create(BusRequest $request, BusRepo $busRepo)
    {
        $capacity = $request->capacity;
        $type = $request->type;
        $plate_number = $request->plate_number;


        $user = auth('api')->user();
        $id = $user->id;

        $bus = $busRepo->create($id, $capacity, $type, $plate_number);

        return response()->json([
            'message' => 'new bus with this info ' . $bus . "crated"
        ]);

    }


    public function edit(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'plate_number' => 'required',


        ]);
        if ($validator->failed()) {
            return response()->json($validator->errors()->first(), 422);
        }

        $bus = Bus::where('plate_number', '=', $request->plate_number)->first();//return collection(an array of models).
        if (!$bus) {
            return response()->json([
                'message' => 'this bus does not exist in system.'
            ]);

        }


        if ($request->has('type')) {
            Bus::where('plate_number', $request->plate_number)
                ->update(['type' => $request->type]);
        }
        if ($request->has('capacity')) {
            Bus::where('plate_number', $request->plate_number)
                ->update(array('capacity' => $request->capacity));
        }


        return response()->json([
            'message' => 'edit bus done successfuly.']);
    }


    public function delete(Request $request)
    {
        $bus = Bus::findOrFail($request->id);
        $bus->delete();
        return response()->json(['deleted_at' => $bus->deleted_at], 200);
    }
}
