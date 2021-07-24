<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkout()
    {
        $cart = session()->get('cart');

        if(count($cart->items)>0){
            return view('cart.pages.shopping-cart.checkout');
        }
        else{
            return redirect(route('home'))->with('error','Your cart is empty');
        }
    }
}
