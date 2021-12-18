<?php

namespace App\Http\Controllers;

use App\Interfaces\ReservationRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ReceiptController;

class PaymentController extends Controller
{
    public $amount;


    public function request(Request $request)
    {
        $receptController = new ReceiptController();
        $this->amount = $receptController->getReceipt();


        /*
         * ZarinPal Advanced Class
         *
         * version 	: 1.0
         * link 	: https://vrl.ir/zpc
         *
         * author 	: milad maldar
         * e-mail 	: miladworkshop@gmail.com
         * website 	: https://miladworkshop.ir
        */

        require_once("zarinpal_function.php");

        $MerchantID = "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx";
        $Amount = $this->amount;
        $Description = "تراکنش زرین پال";
        $Email = "";
        $Mobile = "";
        $CallbackURL = "/verify";
        $ZarinGate = true;
        $SandBox = true;

        $zp = new \zarinpal_function();
        $result = $zp->request($MerchantID, $Amount, $Description, $Email, $Mobile, $CallbackURL, $SandBox, $ZarinGate);

        if (isset($result["Status"]) && $result["Status"] == 100) {

            // Success and redirect to pay
            $zp->redirect($result["StartPay"]);
        } else {
            // error
            return response()->json(['message' => "خطا در ایجاد تراکنش"]);
            return response()->json(["کد خطا : " => $result["Status"]]);
            return response()->json(["تفسیر و علت خطا : " => $result["Message"]]);

        }
    }

    public function verify()
    {
        /*
         * ZarinPal Advanced Class
         *
         * version 	: 1.0
         * link 	: https://vrl.ir/zpc
         *
         * author 	: milad maldar
         * e-mail 	: miladworkshop@gmail.com
         * website 	: https://miladworkshop.ir
        */

        require_once("zarinpal_function.php");

        $MerchantID = "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx";
        $Amount = 100;
        $ZarinGate = true;
        $SandBox = true;
        $zp = new \zarinpal_function();
        $result = $zp->verify($MerchantID, $Amount, $SandBox, $ZarinGate);

        if (isset($result["Status"]) && $result["Status"] == 100) {
            // Success
            return response()->json(['message' => "تراکنش با موفقیت انجام شد"]);
            return response()->json([' :مبلغ' => $result["Amount"]]);
            return response()->json(["کد پیگیری : " => $result["RefID"]]);
            return response()->json(["Authority : " => $result["Authority"]]);


        } else {
            // error
            return response()->json(['message' => "پرداخت ناموفق"]);
            return response()->json(["کد خطا :" => $result["Status"]]);
            return response()->json(["تفسیر و علت خطا : " => $result["Message"]]);

        }
    }
}
