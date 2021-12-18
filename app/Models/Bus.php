<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bus extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'plate_number',
        'type',
        'capacity',
        'number',
        'user_id'
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }



}
