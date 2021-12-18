<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable=[
    'starting_point',
    'destination',
    'departure_time',
    'arrival_time',
    'fare_amount',
    'bus_id',
    'driver_id',
    'departure_date',
    'arrival_date'
    ];
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

     public function buses()
    {
        return $this->belongsTo(Bus::class);
    }
     public function drivers()
    {
        return $this->belongsTo(Driver::class);
    }



}
