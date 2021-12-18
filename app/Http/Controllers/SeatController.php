<?php

namespace App\Http\Controllers;
use App\Interfaces\ReservationRepo;
use Illuminate\Http\Request;


class SeatController extends Controller
{
    private $reservationRepo;

    public function __construct(ReservationRepo $reservationRepo)
    {
        $this->reservationRepo = $reservationRepo;
    }

    public function showSeats(Request $request)
    {
        $schedule_id = $request->schedule_id;
        $seats = $this->reservationRepo->showSeatStatus($schedule_id);

        $reservedSeats = [];
        foreach ($seats as $seat) {
            $reservedSeats[$seat->seat_number] = $seat->gender;
        }

        $seats_status = [];

        for ($i = 1; $i <= 12; $i++) {

            if (array_key_exists($i, $reservedSeats)) {
                $seats_status[$i] = ['reserved', $reservedSeats[$i]];
            } else {
                $seats_status[$i] = 'empty';
            }
        }

        return response()->json($seats_status);
    }
}
