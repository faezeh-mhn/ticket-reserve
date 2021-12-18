<?php

namespace App\Interfaces;

interface ReservationRepo
{
   public function createReservation($reservation);
   public function checkReservedSeat($reservation);
   public function showSeatStatus($schedule_id);
   public function setTicketStatus($id);
   public function getReserveID();
}


