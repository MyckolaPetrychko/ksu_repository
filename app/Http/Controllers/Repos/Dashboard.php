<?php

namespace App\Http\Controllers\Repos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repos\ReposModel;
use App\Repos\RepoTypeModel;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;

class Dashboard extends Controller
{
  public function index(){
    $res = RepoTypeModel::all();
    $label = array();
    if (!$res){
      return view("error");
    }
    foreach($res as $r){
      array_push($label, $r['name']);
    }
    return view('dashboard', ['labels' => $label]);
  }

  public function addDisert(Request $request){
    $this->validate($request, [
        'title' => 'required|unique:repo|max:255',
        'author' => 'required|max:150',
        'info'   => 'required|max:500',
        'year'   =>  'required|digits:4',
        'type1'  =>  'required',
        'type2'  =>  'required',
        'file'   =>  'required'
    ]);
    $author = $request->input('author');
    $title = $request->input('title');
    $year = $request->input('year');
    $info = $request->input('info');
    $type1 = $request->input('type1');
    $type2 = $request->input('type2');
    $file = $request->file('file');
    $repoType = RepoTypeModel::all()->where('name', $type2);
    $repType = 0;
    foreach ($repoType->toArray() as $rt){
        $repType = $rt['id'];
    }
    $user = Auth::user();
    $res = Storage::disk('public')->put($author . $year . $repType, $file);
    $src = '<a href = "/files/get?name='. $res .'" target = "blank">Скачати повний текст</a>';
  //  var_dump($src);exit;
    $repo = new ReposModel;
    $repo->author = $author;
    $repo->title = $title;
    $repo->year = $year;
    $repo->info = $info;
    $repo->speciality = $type1 . '/' . $type2;
    $repo->type = $repType;
    $repo->download = $src;
    $repo->added = $user->id;
    $repo->date = date('Y-m-d H:i:s');
    $repo->save();
    $res = RepoTypeModel::all();
    $label = array();
    if (!$res){
      abort(500);
    }
    foreach($res as $r){
      array_push($label, $r['name']);
    }
    return view('dashboard', ['success' => "Дисертацію додано", 'labels' => $label]);
  }


}
