<?php
/**
 * Created by PhpStorm.
 * User: Udara
 * Date: 7/19/2021
 * Time: 8:43 PM
 */

namespace App\Repositories\Eloquent;


use App\Models\Billing;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderRepository extends BaseRepository
{
    private $billing, $product;

    public function __construct(Order $model, Billing $billing, Product $product)
    {
        parent::__construct($model);
        $this->billing = $billing;
        $this->product = $product;
    }

    //store order
    public function store($request, $order)
    {
        DB::beginTransaction();

        try {
            $products = unserialize($order['cart']);

            //remove product quantity
            foreach ($products->items as $item) {
                $product = $this->product->find($item['product_id']);

//                return if product not available
                if ($product->qty < $item['quantity']) {
                    return redirect(route('cart.index'))->with('error', 'Sorry ' . $item['title'] . ' is not available. Please remove it and continue');
                }

                $product->decrement('qty', $item['quantity']);
            }

            $order_data = $this->model->create($order);

            $billing_data = array_merge($request->all(['email', 'address', 'country', 'province', 'zip']),
                ['name' => ($request->f_name . ' ' . $request->l_name), 'order_id' => $order_data->id]);

            $this->billing->create($billing_data);



            DB::commit();
            session()->forget('cart');
            return redirect(route('home'))->with('success', 'Order Place Successfully');
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            return redirect()->back()->with('error', 'Order not place, Something went wrong');

        }
    }

    public function orderByUser()
    {
        return $this->model->where('customer_id', auth()->user()->id)->with('billing')->paginate(5);
    }

    public function orders()
    {
        return $this->model->with(['billing', 'user'])->get();
    }

    public function order($id)
    {
        return $this->model->with(['billing', 'user'])->findOrFail($id);
    }
}
