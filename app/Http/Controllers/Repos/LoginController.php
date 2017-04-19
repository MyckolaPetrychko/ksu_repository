<?php

namespace App\Http\Controllers\Repos;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function index(){
      return view('login');
    }

    public function authenticate(){
      $password = request('password');
      $email = request('email');
      $remember = request('remember');
      if ($remember == null){
        $remember = false;
      }else{
        $remember = true;
      }
      if (Auth::attempt(['email' => $email, 'password' => $password], $remember)){
        return redirect()->intended('profile');
      }
      return view("/login", ['error' => "Неправильний емейл чи пароль"]);
    }
}
