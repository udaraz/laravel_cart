<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\ProductRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    private $category_repo, $product_repo;

    public function __construct(CategoryRepository $category_repository, ProductRepository $productRepository)
    {
        $this->middleware('role:Admin|Operation Manager',['except'=>'show']);

        $this->category_repo = $category_repository;
        $this->product_repo = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->category_repo->getAll();

        return view('back-office.products.add-product', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request);
        return $this->product_repo->store($request);
    }

//    validate request
    private function validator(Request $request)
    {
        $rules = [
            'title' => 'required|min:5|max:255',
            'category_id' => 'required',
            'price' => 'required',
            'qty' => 'required|numeric|min:0',
            'file' => 'image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'description'=>'required|min:5|max:1000'
        ];

        //validate the request.
        $request->validate($rules);
    }

    public function manage(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->product_repo->getAll();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('category', function ($data) {
                    return $data->category['category'];
                })
                ->editColumn('images', function ($data) {
                    return $data->images;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('back-office.products.manage-product');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->product_repo->find($id);
        $categories = $this->category_repo->getAll();

        return view('back-office.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validator($request);
        return $this->product_repo->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->product_repo->destroy($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function imageDestroy($id)
    {
        $delete_image = $this->product_repo->imageDestroy($id);
        if ($delete_image) {
            return redirect()->back()->with('message', 'Image deleted!');
        }else{
            return redirect()->back()->withErrors('Image not deleted!');
        }
    }

    public function show($id)
    {
        $product = $this->product_repo->find($id);

        return view('cart.pages.single-product',compact('product'));
    }
}
