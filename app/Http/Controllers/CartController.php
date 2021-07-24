<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquent\ProductRepository;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private $product_repo;

    public function __construct(ProductRepository $productRepository)
    {
        $this->product_repo = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cart.pages.shopping-cart.cart');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function addToCart($id)
    {
        $product = $this->product_repo->find($id);
        $image = count($product['images']) > 0 ? $product['images'][0]->image : 'assets/img/no-img.png';

        $cart = session()->get('cart', []);
        $total_price = isset($cart->total) ? $cart->total : 0;
        $total_count = isset($cart->count) ? $cart->count : 0;

        $items = isset($cart->items) ? $cart->items : [];

        if (isset($cart->items[$id])) {
            if (array_key_exists($id, $cart->items)) {
                $cart->items[$id]['quantity']++;
                $items[$id] = $cart->items[$id];
            }
        } else {
            $items[$id] = [
                "product_id" => $product->id,
                "title" => $product->title,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $image,
                "available" => $product->qty
            ];
        }
        $total_price += $items[$id]['price'];
        $total_count++;
        $final_cart = (object)['items' => $items, 'total' => $total_price, 'count' => $total_count];

        session()->put('cart', $final_cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $total_count = ($cart->count - $cart->items[$request->id]["quantity"]) + $request->quantity;
            $total_price = ($cart->total - ($cart->items[$request->id]["price"] * $cart->items[$request->id]["quantity"])
                + ($cart->items[$request->id]["price"] * $request->quantity));

            $cart->items[$request->id]["quantity"] = $request->quantity;

            $cart->total = $total_price;
            $cart->count = $total_count;

            session()->put('cart', $cart);
            session()->flash('success', 'Product updated successfully');
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');

            if (isset($cart->items[$request->id])) {
                $total_count = ($cart->count - $cart->items[$request->id]["quantity"]);
                $total_price = ($cart->total - ($cart->items[$request->id]["price"] * $cart->items[$request->id]["quantity"]));
                unset($cart->items[$request->id]);

                $cart->total = $total_price;
                $cart->count = $total_count;
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
}
