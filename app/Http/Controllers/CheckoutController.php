<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Billing\PaymentGetWay;
use App\Models\Order;
use App\Models\Product;
use App\Mail\OrderHasBeenCreated;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function store(PaymentGetWay $mpesa)
    {
        request()->validate([
            'number' => 'required',
            'city' => 'required',
            'address' => 'required',
            'amount' => 'required',
        ]);

        $mpesa->payTo(request('number'), request('amount'));

        $product = Product::findOrFail(request('productId'));

        $order = Order::create([
            'user_id' => auth()->id(),
            'number' => request('number'),
            'city' => request('city'),
            'address' => request('address'),
            'amount' => request('amount'),
            'name' => $product->name,
            'description' => $product->description,
            'image' => asset($product->image)
        ]);

        Mail::to('abdilatiif802@gmail.com')
            ->queue(new OrderHasBeenCreated(auth()->user(), $product));


        return redirect('/orders');
    }

    public function booking(PaymentGetWay $mpesa)
    {
        request()->validate([
            'number' => 'required',
            'city' => 'required',
            'address' => 'required',
            'amount' => 'required',
        ]);

        $mpesa->payTo(request('number'), request('amount'));
        
        return redirect('/events');
    }   
}
