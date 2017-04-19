<?php

namespace App\Http\Controllers\Repos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UpdatePassword extends Controller
{
  public function index(){
    $old = request('old_password');
    $new = request('password');
    $confirm = request('password_confirmation');
    $user = Auth::user();
    $dbuser = User::all()->where('id', $user['id']);
    if (!$dbuser){
      return view('/login');
    }
    if ($new != $confirm){
      return view('/profile', ['error' => 'Введені паролі не співпадають']);
    }
    if (!Auth::attempt(['email' => $dbuser->toArray()[0]['email'], 'password' => $old])){
      return view('/profile', ['error' => 'Неправильний старий пароль']);
    }
    $new = Hash::make($new);
    DB::table('users')->where('id', $user['id'])->update(['password' => $new]);
    return view('/profile', ['info' => "Пароль змінено"]);
  }
}
