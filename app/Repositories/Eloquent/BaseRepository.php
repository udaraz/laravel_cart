<?php
/**
 * Created by PhpStorm.
 * User: Udara
 * Date: 7/19/2021
 * Time: 8:46 PM
 */

namespace App\Repositories\Eloquent;


use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}
