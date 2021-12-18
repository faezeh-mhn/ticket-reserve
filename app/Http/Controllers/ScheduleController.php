<?php

namespace App\Http\Controllers;

use App\Http\Requests\scheduleRequest;
use App\Http\Requests\scheduleShowRequest;
use App\Interfaces\BusRepo;
use App\Interfaces\DriverRepo;
use App\Interfaces\ScheduleRepo;
use App\Models\Bus;
use App\Models\Driver;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
    public $busRepo;
    public $driverRepo;
    public $scheduleRepo;

    public function __construct(BusRepo $busRepo, DriverRepo $driverRepo, ScheduleRepo $scheduleRepo)
    {
        $this->busRepo = $busRepo;
        $this->driverRepo = $driverRepo;
        $this->scheduleRepo = $scheduleRepo;
    }

    public function create(scheduleRequest $request)
    {
        $data = $request->all();
        $plate_number = $request->platenumber;
        $bus = $this->busRepo->getBus($plate_number);


        if (!$bus) {
            return response()->json([
                'message' => 'this bus does not exist in system.'
            ]);
        }
        $driver = $this->driverRepo->getDriver();
        if (!$driver) {

            return response()->json([
                'message' => 'this driver does not exist in system.'
            ]);
        }
        $this->scheduleRepo->createSchedule($request->startingpoint, $request->destination, $request->departuretime, $request->arrivaltime,
            $request->fare, $bus->id, $driver->id);

        return response()->json(
            ['message' => 'new schedule of trip created']
        );


    }


    public function show(scheduleShowRequest $request)
    {
        $data = $request->all();//return associative array

        $order = 'ASC';
        $filter = 'departure_time';
        $items = ['most_expensive', 'cheapest', 'earliest', 'latest'];

        foreach ($items as $item) {
            if (array_key_exists($item, $data)) {
                if ($data[$item] == 1) {
                    $filter = $item;

                }
                break;
            }
        }

        if ($filter == $items[0] || $filter == $items[3]) {
            $order = 'desc';

        }

        if ($filter == $items[0] || $filter == $items[1]) {
            $filter = 'fare_amount';
        } elseif ($filter == $items[2] || $filter == $items[3]) {
            $filter = 'departure_time';

        }


        $schedules = Schedule::where('starting_point', "=", "$request->starting_point")
            ->where('destination', "=", $request->destination)
            ->where('departure_date', "=", "$request->departure_date")
            ->orderBy($filter, $order);

        if ($request->has('type')) {
            $schedules = $schedules->where('type', "=", $request->type)->get(['id', 'starting_point', "destination", "departure_date", "departure_time", "fare_amount", "bus_id", 'type']);
        } elseif ($request->has('capacity')) {
            $schedules = $schedules->OrderBy('capacity', 'desc')->get(['id', 'starting_point', "destination", "departure_date", "departure_time", "fare_amount", "bus_id", 'type', 'capacity']);
        } else {
            $schedules = $schedules->get(['id', 'starting_point', "destination", "departure_date", "departure_time", "fare_amount", "bus_id", 'type', 'capacity']);
        }
        if ($schedules->isEmpty()) {
            $schedules = 'not found';
        }
        return response()->json([
            'available schedules' => $schedules
        ]);

    }

    public function update(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'id' => 'required'//id for determine which schedule choosen  is required.
        ]);
        if ($validator->failed()) {
            return response()->json($validator->errors()->first(), 422);
        }

        if ($request->has('platenumber')) {
            $plate_number = $request->platenumber;
            $bus = Bus::where('plate_number', '=', $plate_number)->first();//return collection(an array of models).
            if (!$bus) {
                return response()->json([
                    'message' => 'this bus does not exist in system.'
                ]);
            }
        }
        if ($request->has('contactdriver')) {
            $contact_driver = $request->contactdriver;
            $driver = Driver::where('contact', "=", $contact_driver)->first();
            if (!$driver) {

                return response()->json([
                    'message' => 'this driver does not exist in system.'
                ]);
            }
        }
        if ($request->has('platenumber')) {
            Schedule::where('id', $request->id)
                ->update(['bus_id' => $bus->id]);
        }


        if ($request->has('contactdriver')) {
            Schedule::where('id', $request->id)
                ->update(['driver_id' => $driver->id]);
        }


        if ($request->has('startingpoint')) {
            Schedule::where('id', $request->id)
                ->update(['starting_point' => $request->startingpoint]);
        }


        if ($request->has('destination')) {
            Schedule::where('id', $request->id)
                ->update(['destination' => $request->destination]);
        }
        if ($request->has('departuretime')) {
            Schedule::where('id', $request->id)
                ->update(['departure_time' => $request->departuretime]);
        }
        if ($request->has('arrivaltime')) {
            Schedule::where('id', $request->id)
                ->update(['arrival_time' => $request->arrivaltime]);
        }
        if ($request->has('fare')) {
            Schedule::where('id', $request->id)
                ->update(['fare_amount' => $request->fare]);
        }
        if ($request->has('fare')) {
            Schedule::where('id', $request->id)
                ->update(['fare_amount' => $request->fare]);
        }


        return response()->json(
            ['message' => ' schedule of trip updated']
        );
    }


}
