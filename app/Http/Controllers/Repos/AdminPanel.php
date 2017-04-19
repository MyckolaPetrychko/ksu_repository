<?php

namespace App\Http\Controllers\Repos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Repos\Role;
use App\Repos\RepoTypeModel;
use Illuminate\Support\Facades\Hash;

class AdminPanel extends Controller
{

    private $paginateCount = 20;

    public function index(){
      $arr = User::paginate($this->paginateCount);
      $roles = Role::all();
      return view('admin', ['users' => $arr, 'roles' => $roles->toArray()]);
    }

    public function addUser(Request $request){
      $this->validate($request, [
          'login' => 'required|unique:users|max:40',
          'email' => 'required|unique:users|max:40'
      ]);
      $login = request("login");
      $email = request("email");
      $password = request("password");
      $type = request("type");
      $user = new User;
      $user->login = $login;
      $user->email = $email;
      $user->password = Hash::make($password);
      $role = Role::all()->where('type', $type);
      $t = 0;
      foreach($role->toArray() as $r){
        $t = $r['id'];
      }
      $user->type = $t;
      $user->save();
      $arr = User::paginate($this->paginateCount);
      $roles = Role::all();
      return view('/admin', ['info' => "Користувача додано", 'users' => $arr, 'roles' => $roles->toArray()]);
    }

    public function addNewDisert(Request $request){
      $this->validate($request, [
          'name' => 'required|unique:allList|max:255',
          'code' => 'required|unique:allList|max:20|regex:/(\d{2,}\.?){3}/'
      ]);
      $res = new RepoTypeModel;
      $res->name = $request->input('name');
      $res->code = $request->input('code');
      $res->save();
      $arr = User::paginate($this->paginateCount);
      $roles = Role::all();
      return view('admin', ['info' => "Новий тип дисертації додано", 'users' => $arr, 'roles' => $roles->toArray()]);
    }
}
