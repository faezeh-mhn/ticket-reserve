<?php

namespace App\Http\Controllers;

use App\Interfaces\ReservationRepo;
use App\Jobs\DeactiveReservation;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
    private $reservationRepo;

    public function __construct(ReservationRepo $reservationRepo)
    {
        $this->reservationRepo = $reservationRepo;
    }

    public function doReservation(Request $request)

    {
        $reservations = $request->all(); //return array

        foreach ($reservations as $reservation) {
            $reservation['paid'] = 0;
            $check = $this->reservationRepo->checkReservedSeat($reservation);
            if ($check == true) {
                return response()->json(['message' => "selected seat not available"]);
            }

            $this->reservationRepo->createReservation($reservation);

        }
        DeactiveReservation::dispatch()->delay(now()->addMinutes(15));
        return response()->json(['message' => "your reserve done successfuly"]);
    }
}
