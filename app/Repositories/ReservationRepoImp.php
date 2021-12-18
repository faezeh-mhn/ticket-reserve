<?php

namespace App\Repositories;

use App\Interfaces\ReservationRepo;
use App\Models\Reservation;

class ReservationRepoImp implements ReservationRepo
{
    public function createReservation($reservation)
    {

        Reservation::create($reservation);


    }

    public function checkReservedSeat($reservation)
    {
        $check = Reservation::where('seat_number', "=", $reservation['seat_number'])
            ->where('status', "!=", "available")
            ->first();
        return $check;
    }

    public function setTicketStatus($id)
    {

        $ticketStatus = Reservation::where('paid', "=", 0)->
        where('user_id', "=", $id)->update(["paid" => 1, "ticketStatus" => 'waiting']);

    }
     public function getReserveID()
    {
        $reservesId = Reservation::where('paid', "=", 1)->
        where('user_id', "=", 6)
            ->where("ticketStatus", "=", 'waiting')->get("id");
        return $reservesId;
    }

    public function showSeatStatus($schedule_id)
    {
        $seats = Reservation::where('schedule_id', "=", $schedule_id)
            ->get(['seat_number', 'gender']);
        return $seats;
    }


}

