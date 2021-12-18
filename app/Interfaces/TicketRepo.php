<?php

namespace App\Interfaces;

interface TicketRepo
{
   public function createTicket($reservesId);
   public function getTicket();
   public function doExpiration();
}
