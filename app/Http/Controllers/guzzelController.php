<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class guzzelController extends Controller
{
    public function test()
    {
       $collect = Bus::get();
     var_dump($collect);
    }
}
