<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
    'name',
    'last_name',
    'seat_number',
    'fare_amount',
    'paid',
    'date_of_booking',
    'schedule_id',
    'user_id',
    'id_card',
    'ticketStatus'
    ];
    public function schedules()
    {
        return $this->belongsTo(Reservation::class);
    }
    public function disbursements()
    {
        return $this->hasOne(Disbursement::class);
    }

     public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function tickets()
    {
       return $this->hasOne(Ticket::class);
    }
}
