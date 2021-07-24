<?php

namespace App\View\Components;

use App\Repositories\Eloquent\ProductRepository;
use Illuminate\View\Component;

class CategorySection extends Component
{
    public $category_id;
    private $product_repo;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id,ProductRepository $product_repository)
    {
        $this->category_id = $id;
        $this->product_repo = $product_repository;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $products = $this->product_repo->getProductByCategory($this->category_id);
        return view('cart.components.category-section', compact('products'));
    }
}
