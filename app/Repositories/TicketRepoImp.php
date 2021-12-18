<?php

namespace App\Repositories;

use App\Interfaces\TicketRepo;
use App\Models\Reservation;
use App\Models\Ticket;
use App\Models\User;

class TicketRepoImp implements TicketRepo
{
    public function createTicket($reservesId)
    {
        foreach ($reservesId as $id)
            Ticket::create([
                'reservation_id' => $id->id,
                'status' => 'active',
                'user_id' => 6
            ]);
        Reservation::where('user_id', "=", 6)
            ->update(['ticketStatus' => "created"]);

    }

    public function getTicket()
    {
        $tickets = Reservation::whereHas('tickets', function ($q) {
            $q->where('visitedStatus', '=', 'notShowed');
        })->where('user_id', "=", 6)->get();
        return $tickets;

    }

    public function doExpiration()
    {
        Ticket::where('user_id', "=", 6)
            ->where('visitedStatus', '=', 'notShowed')
            ->update(['visitedStatus' => "Showed"]);

    }

}
