<?php

namespace App\Repositories;

use App\Interfaces\UserRepo;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepoImp implements UserRepo
{
    public function makeTotal($id)
    {

        return Reservation::where('user_id', '=', $id)->where("paid", "=", 0)->where('status',"=","reserve")->sum('fare_amount');
    }

    public function getUser($id)
    {

        $user = User::where('id', '=', $id)->get();
        $name = $user[0]->name;
        return $name;
    }

}
