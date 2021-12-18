<?php

namespace App\Providers;

use App\Interfaces\BusRepo;
use App\Interfaces\DriverRepo;
use App\Interfaces\ReservationRepo;
use App\Interfaces\ScheduleRepo;
use App\Interfaces\TicketRepo;
use App\Interfaces\UserRepo;
use App\Repositories\BusRepoImp;
use App\Repositories\BusRepoImpement;
use App\Repositories\DriverRepoImp;
use App\Repositories\ReservationRepoImp;
use App\Repositories\ScheduleRepoImp;
use App\Repositories\TicketRepoImp;
use App\Repositories\UserRepoImp;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
         $this->app->bind(UserRepo::class, UserRepoImp::class);
         $this->app->bind(ReservationRepo::class,ReservationRepoImp::class);
         $this->app->bind(TicketRepo::class,TicketRepoImp::class);
         $this->app->bind(BusRepo::class,BusRepoImpement::class);
         $this->app->bind(ScheduleRepo::class,ScheduleRepoImp::class);
         $this->app->bind(DriverRepo::class,DriverRepoImp::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
