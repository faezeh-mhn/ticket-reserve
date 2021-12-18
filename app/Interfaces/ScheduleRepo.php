<?php

namespace App\Interfaces;

interface ScheduleRepo
{
public function createSchedule($startingpoint, $destination, $departuretime, $arrivaltime, $fare, $busId, $driverId);
public function getSchedule();
}
