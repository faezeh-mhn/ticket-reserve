<?php

namespace App\Interfaces;

interface BusRepo
{
public function getBus($plate_number);
public function create($id, $capacity, $type, $plate_number);
public function edit();
}

