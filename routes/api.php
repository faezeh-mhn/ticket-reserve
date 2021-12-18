<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::middleware('auth:api')->get('test', function (Request $request) {
    $user = auth('api')->user();
    dd($user->id);
});


Route::post('users/register', [\App\Http\Controllers\passportAuthController::class, 'registerUSer']);
Route::post('users/login', [\App\Http\Controllers\passportAuthController::class, 'loginUSer']);

Route::middleware('auth:api')->post('bus/create', [\App\Http\Controllers\BusController::class, 'create']);
Route::post('bus/edit', [\App\Http\Controllers\BusController::class, 'edit']);

Route::post('schedule/create', [\App\Http\Controllers\ScheduleController::class, 'create']);
Route::post('schedule/update', [\App\Http\Controllers\ScheduleController::class, 'update']);
Route::post('schedule/show', [\App\Http\Controllers\ScheduleController::class, 'show']);


Route::get('/description', [\App\Http\Controllers\DescriptionController::class, 'showDescription']);

Route::get('/companies', [\App\Http\Controllers\CompanyController::class, "show"]);
Route::get('/comments', [\App\Http\Controllers\CommentController::class, "show"]);

/////////////////////////////////phase{D}
Route::get('/seats/{schedule_id}', [\App\Http\Controllers\SeatController::class, "showSeats"]);
Route::middleware('auth:api')->group(function () {
    Route::post('/reserve', [\App\Http\Controllers\ReservationController::class, 'doReservation']);
    Route::get('/receipt', [\App\Http\Controllers\ReceiptController::class, "showReceipt"]);

});

Route::get('/unAuthenticate', [\App\Http\Controllers\passportAuthController::class, "unAuthenticate"])->name('login');

Route::get("salam", [\App\Http\Controllers\helpingController::class, "helping"]);

Route::get("/request", [\App\Http\Controllers\PaymentController::class, "request"]);
Route::get("/verify", [\App\Http\Controllers\PaymentController::class, "verify"]);
Route::middleware('auth:api')->group(function () {

    Route::get("/ticket/show", [\App\Http\Controllers\TicketController::class, "setTicketStatus"]);
    Route::get("/ticket/show", [\App\Http\Controllers\TicketController::class, "getTicket"]);
    Route::get("/ticket/show", [\App\Http\Controllers\TicketController::class, "makeTicket"]);
    Route::get("/ticket/show", [\App\Http\Controllers\TicketController::class, "showTicket"]);
    Route::get("/ticket/show", [\App\Http\Controllers\TicketController::class, "createTicket"]);

});
