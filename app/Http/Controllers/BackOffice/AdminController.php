<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\AdminRepository;
use App\Repositories\Eloquent\RoleRepository;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $role_repo,$admin_repo;
    public function __construct(RoleRepository $role_repository, AdminRepository $admin_repository)
    {
        $this->middleware('role:Admin',['only'=>['adminCreate','store']]);

        $this->role_repo = $role_repository;
        $this->admin_repo = $admin_repository;
    }

    /**
     * Show Back Office.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('back-office.dashboard');
    }

    public function adminCreate(){
        $roles = $this->role_repo->getRoles();

        return view('back-office.admin.create-user',compact('roles'));
    }

    public function store(Request $request){
        return $this->admin_repo->store($request);
    }

    private function validator(Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required'],
        ];

        $messages = [
            'role_id.required' => 'The Role must have selected',
        ];

        //validate the request.
        $request->validate($rules,$messages);
    }
}
