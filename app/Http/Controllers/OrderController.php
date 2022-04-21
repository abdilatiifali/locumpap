<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Product;
use App\Http\Resources\ProductResource;

class OrderController extends Controller
{
    public function index()
    {
        $userOrders = auth()->user()->load('orders');
        
        return Inertia::render('Orders/Index', [
            'userOrders' => $userOrders
        ]);
    }

    public function getProducts()
    {
        $productIds = auth()->user()->orders()->pluck('product_id');

        return Product::whereIn('id', $productIds)->get();
    }
}
