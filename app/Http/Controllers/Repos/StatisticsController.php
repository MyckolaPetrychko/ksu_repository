<?php

namespace App\Http\Controllers\Repos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repos\ReposModel;
use App\Repos\RepoTypeModel;

class StatisticsController extends Controller
{
    public function index(){
      return view('statistics');
    }

    public function dist(){
      $all = RepoTypeModel::all();

      $datas = array();
      $labels = array();
      $backgroundColor = array();
      $hoverBackgroundColor = array();

      foreach ($all as $row) {
          $r = ReposModel::all()->where('type', $row['id'])->count();
          $datas[$row['name']] = $r;
          $labels[$row['name']] = $row['name'];
          array_push($backgroundColor, "#" . $this->random_color());
          array_push($hoverBackgroundColor, "#" . $this->random_color());
      }

      $year = ReposModel::all()->groupBy('year');
      $countYear = array();
      $backgroundColorY = array();
      $hoverBackgroundColorY = array();
      foreach($year as $y=>$v){
        //array_push($countYear, array($y => $v));
        $countYear[$y] = count($v);
        array_push($backgroundColorY, "#" . $this->random_color());
        array_push($hoverBackgroundColorY, "#" . $this->random_color());
      }
      ksort($countYear);

      $p = ($this->utf8ize(array("labels" => $labels, "datasets" => ["data" => $datas,
          "backgroundColor" => $backgroundColor,
        "hoverBackgroundColor" => $hoverBackgroundColor,
        "yearDistribution" => array("dist" => $countYear,
                              "backgroundColor" => $backgroundColorY,
                              "hoverBackgroundColor" => $hoverBackgroundColorY)])));
        return $p;
    }

    private function utf8ize($d) {
        if (is_array($d)) {
            foreach ($d as $k => $v) {
                $d[$k] = $this->utf8ize($v);
            }
        } else if (is_string ($d)) {
            return utf8_encode($d);
        }
        return $d;
    }

    private function random_color_part() {
        return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }

    private function random_color() {
        return $this->random_color_part() . $this->random_color_part() . $this->random_color_part();
    }
}
