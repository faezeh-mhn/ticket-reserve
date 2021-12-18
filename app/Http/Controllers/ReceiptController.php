<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepo;
use Illuminate\Support\Facades\Auth;

class ReceiptController extends Controller
{
    private $userRepo;
    public $amount;

    public function __construct(UserRepo $userRepo)
    {
        $this->userRepo = $userRepo;
        $this->showReceipt();

    }


    public function showReceipt()
    {
        try {
            $user = Auth::user();
            $id = $user->id;

            $name = $this->userRepo->getUser($id);
            $this->amount = $this->userRepo->makeTotal($id);
            return response()->json(['name' => $name, "Total" => $this->userRepo->makeTotal($id)]);

        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }

}
