<?php


namespace App\Repositories;

use App\Interfaces\ScheduleRepo;
use App\Models\Schedule;


class ScheduleRepoImp implements ScheduleRepo
{
    public function createSchedule($startingpoint, $destination, $departuretime, $arrivaltime, $fare, $busId, $driverId)
{
        Schedule::create([
            'starting_point' => startingpoint,
            'destination' => $destination,
            'departure_time' => $departuretime,
            'arrival_time' => $arrivaltime,
            'fare_amount' => $fare,
            'bus_id' => $busId,
            'driver_id' => $driverId
        ]);
    }
    public function getSchedule()
    {
        // TODO: Implement getSchedule() method.
    }
}
