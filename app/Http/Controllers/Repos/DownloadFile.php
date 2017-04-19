<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadFile extends Controller
{
    public function index(){
      var_dump(request('name'));exit;
      return response();
    }
}
