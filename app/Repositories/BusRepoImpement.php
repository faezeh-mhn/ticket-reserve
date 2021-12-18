<?php


namespace App\Repositories;

use App\Interfaces\BusRepo;
use App\Models\Bus;


class BusRepoImpement implements BusRepo
{
    public function getBus($plate_number)
    {
        $bus = Bus::where('plate_number', '=', $plate_number)->first();//return collection(an array of models).
        return $bus;
    }

    public function create($id, $capacity, $type, $plate_number)
    {
        $bus = Bus::create([
            'user_id' => $id,
            'capacity' => $capacity,
            'type' => $type,
            'plate_number' => $plate_number
        ]);
        return $bus;

    }
    public function edit()
    {
        // TODO: Implement edit() method.
    }
}

