<?php

namespace App\Http\Controllers;

use Midtrans\Config;
use Illuminate\Http\Request;

class CheckOutController extends Controller
{
    

    public function sendBayar(){

            
//         // Set your Merchant Server Key
//         Config::$serverKey = config('midtrans.server_key');
//         // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
//         Config::$isProduction = false;
//         // Set sanitization on (default)
//         Config::$isSanitized = true;
//         // Set 3DS transaction for credit card to true
//         Config::$is3ds = true;

//         $params = array(
//     'transaction_details' => array(
//         'order_id' => rand(),
//         'gross_amount' => 10000,
//     ),
//     'customer_details' => array(
//         'first_name' => 'budi',
//         'last_name' => 'pratama',
//         'email' => 'budi.pra@example.com',
//         'phone' => '08111222333',
//     ),
// );
    }
}
