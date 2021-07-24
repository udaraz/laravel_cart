<?php
/**
 * Created by PhpStorm.
 * User: Udara
 * Date: 7/23/2021
 * Time: 12:51 PM
 */

namespace App\Repositories\Eloquent;


use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminRepository extends BaseRepository
{
    public function __construct(Admin $model)
    {
        parent::__construct($model);
    }

    public function store($request){
        DB::beginTransaction();
        try{
            $admin =  $this->model->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $admin->assignRole($request->role_id);
            DB::commit();
            return redirect()->back()->with('message', 'User create successfully');
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'User create error');
        }

    }
}
