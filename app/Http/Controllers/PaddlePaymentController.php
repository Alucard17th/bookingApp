<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
class PaddlePaymentController extends Controller
{
    //
    public function pay(Request $request, $priceId)   
    {
        $product = Product::where('paddle_price_id', $priceId)->first();
        // $checkout = $request->user()->checkout($priceId)
        // ->returnTo(route('dashboard'));

        $checkout = $request->user()->subscribe($priceId)
        ->customData(['user_id' => $request->user()->id])
        ->returnTo(route('dashboard'));

        return view('paddle.pay', compact('checkout', 'product'));
    }

    public function handle(Request $request)
    {
        // log the request data
        $data = $request->all();
        Log::info($request->all()   );

        // handle the payment

    }
}
