<?php

namespace App\Http\Controllers\Repos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repos\ReposModel;
use App\Repos\RepoTypeModel;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;

class RepoController extends Controller
{
    private $paginateCount = 20;
    public function index() {
      $res = ReposModel::paginate($this->paginateCount);
      $labels = $this->availableDisert();
      return view('welcome', ['res' => $res, 'labels' => $labels]);
    }

    public function availableDisert(){
      $res = RepoTypeModel::all();
      $label = array();
      if (!$res){
        abort(500);
      }
      foreach($res as $r){
        array_push($label, $r['name']);
      }
      return $label;
    }

    public function download(){
      $file = storage_path('app/public/') . request('name');
      $exists = Storage::disk('public')->has(request('name'));
      if (!$exists){
        abort(500);
      }
      return response()->download($file);
    }

    public function search(){
      $spec = request('selectFilter1');
      $column = request('selectFilter2');
      $count = request('selectFilter3');
      $query = request('query') ;
      if ($count == 'К-сть дисертацій'){
        $count = $this->paginateCount;
      }
      $tbColumn = $column;
      if ($column == 'Ключові слова'){
        $tbColumn = 'info';
      }else if($column == 'Автор(тільки прізвище)'){
        $tbColumn = 'author';
      }else if($tbColumn == 'Назва'){
          $tbColumn = 'title';
      }else{
        $tbColumn = 'year';
      }
      $res = '';
      if ($spec == 'Усі спеціальності'){
        if ($query == null){
              $res = ReposModel::paginate($count);
        }else{
              $res = ReposModel::where($tbColumn, $query)->orWhere($tbColumn, 'like', '%' . $query . '%')->paginate($count);
        }
      }else{
        $type = RepoTypeModel::where('name', $spec)->get()->toArray();
        $index = 0;
        foreach($type as $t){
            $index = $t['id'];
        }
        if ($query == null){
            $res = ReposModel::where('type', $index)->paginate($count);
        }else{
              $res = ReposModel::where('type', $index)->where($tbColumn, 'like', '%' . $query . '%')->paginate($count);
        }
      }
      $labels = $this->availableDisert();
      return view('welcome', ['res' => $res->appends(Input::query()), 'labels' => $labels]);
    }
}
