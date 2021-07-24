<?php
/**
 * Created by PhpStorm.
 * User: Udara
 * Date: 7/23/2021
 * Time: 12:30 PM
 */

namespace App\Repositories\Eloquent;


use Spatie\Permission\Models\Role;

class RoleRepository extends BaseRepository
{
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }

    public function getRoles()
    {
        return $this->model->get();
    }
}
