<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Repositories\Eloquent\OrderRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    private $order_repo;

    public function __construct(OrderRepository $order_repository)
    {
        $this->middleware('role:Sales Manager',['only'=>['show','orders']]);

        $this->order_repo = $order_repository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!session()->has('cart')) {
            return redirect()->back()->with('error', 'Cart is empty');
        }

        $this->validator($request);

        $cart = session()->get('cart');
        $order = [
            'order_date' => date('yy-m-d'),
            'total' => $cart->total,
            'cart' => serialize($cart),
            'payment_status' => 'paid',
            'customer_id' => auth()->user()->id,
        ];

        return $this->order_repo->store($request, $order);
    }

    private function validator(Request $request)
    {
        $rules = [
            'f_name' => 'required',
            'l_name' => 'required',
            'address' => 'required',
            'country' => 'required',
            'province' => 'required',
            'zip' => 'required',
        ];

        $messages = [
            'f_name.required' => 'The first name field is required',
            'l_name.required' => 'The last name field is required'
        ];

        //validate the request.
        $request->validate($rules, $messages);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    //show single order in back office
    public function show($id)
    {
        $order = $this->order_repo->order($id);

        return view('back-office.sales.order', compact('order'));
    }

    //user order view
    public function orderByUser()
    {
        $orders = $this->order_repo->orderByUser();

        return view('cart.pages.orders.orders', compact('orders'));
    }

    //all sales view from backend
    public function orders(Request $request)
    {
        $orders = $this->order_repo->orders();

        if ($request->ajax()) {
            $data = $this->order_repo->orders();
            return DataTables::of($data)
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('back-office.sales.sales');
    }
}
