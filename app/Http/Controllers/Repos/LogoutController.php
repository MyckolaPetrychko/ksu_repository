<?php

namespace App\Http\Controllers\Repos;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    public function index(){
      Auth::logout();
      return redirect()->intended("/");
    }
}
