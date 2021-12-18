<?php

namespace App\Http\Controllers;

use App\Interfaces\ReservationRepo;
use App\Interfaces\TicketRepo;
use App\Interfaces\UserRepo;
use App\Models\Reservation;
use App\Models\Ticket;

use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

//use App\Models\User;

class TicketController extends Controller
{
    public $reservationRepo;
    public $ticketRepo;
    public $userRepo;
    private $ticket;
    public $id;
    public $printedTicket;


    public function getLoginUserId()
    {
        $user = Auth::user();
        $this->id = $user->id;
        return $this->id;
    }


    public function setTicketStatus(ReservationRepo $reservationRepo)//set status ticket.document to waiting state.
    {

        $reservationRepo->setTicketStatus($this->id);//for clear that somone we have to create ticket.document for them.
    }

    public function createTicket(ReservationRepo $reservationRepo, TicketRepo $ticketRepo)
    {

        $reservesId = $reservationRepo->getReserveID();
        $ticketRepo->createTicket($reservesId);
    }

    public function getTicket(TicketRepo $ticketRepo)
    {
        $this->ticket = $ticketRepo->getTicket();

    }

    public function makeTicket()
    {
        $this->printedTicket = "";
        if (is_array($this->ticket) || is_object($this->ticket)) {
            foreach ($this->ticket as $ticket) {
                $this->printedTicket = $this->printedTicket . "passenger: name:  " . $ticket->name .
                    " lastname:  " . $ticket->last_name . " seatnumber:  " . $ticket->seat_number . "<br>";
            }
        }
    }

    public function showTicket()
    {
        $this->ticketRepo->doExpiration();
        try {

            $data = [
                'title' => 'tickets',
                'date' => $this->printedTicket
            ];

            $pdf = PDF::loadView('pdf', $data);

            return $pdf->download('ticket.pdf');


        } catch (\Throwable $e) {

            return $e->getMessage();
        }
    }

}
