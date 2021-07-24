<?php
/**
 * Created by PhpStorm.
 * User: Udara
 * Date: 7/19/2021
 * Time: 8:43 PM
 */

namespace App\Repositories\Eloquent;


use App\Models\Category;
use App\Models\ProductImage;

class CategoryRepository extends BaseRepository
{

    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function getAll()
    {
        return $this->model->orderBy('category')->get();
    }

    public function getAllWithProductCount()
    {
        return $this->model->withCount('products')->orderBy('category')->get();
    }
}
