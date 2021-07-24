<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\ProductRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $product_repo, $category_repo;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProductRepository $product_repository, CategoryRepository $category_repository)
    {
        $this->product_repo = $product_repository;
        $this->category_repo = $category_repository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = $this->category_repo->getAllWithProductCount();

        return view('cart.pages.home',compact('categories'));
    }
}
