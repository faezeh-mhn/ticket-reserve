<?php


namespace App\Repositories;

use App\Interfaces\DriverRepo;
use App\Models\Driver;


class DriverRepoImp implements DriverRepo
{
public function getDriver()
{

    $driver = Driver::where('contact', "=", 'driver@gmail.com')->first();
    return $driver;
}
}
