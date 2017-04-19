<html lang="{{ config('app.locale') }}">
    <head>
        @include('header')

        <title>Repository</title>
    </head>
    <body>
      @include('common')
      <div class = "container">
        <div class = "row">
          <form action = "/repo/search" method = "get">
              {{ csrf_field() }}
              <div class="col-md-3">
                <select class="form-control" name = "selectFilter1" id="selectFilter1">
                  <option selected>Усі спеціальності</option>
                  <?php
                    foreach($labels as $l=>$k){
                      echo '<option value = "'. $k . '">'. $k . '</option>';
                    }
                   ?>
                </select>
                </div>
                <div class="col-md-2">
                  <select class="form-control" name = "selectFilter3" id="selectFilter3">
                    <option>К-сть дисертацій</option>
                    <option>1</option>
                    <option>5</option>
                    <option>10</option>
                    <option>20</option>
                  </select>
                </div>
                <div class = "col-md-3">
                  <select class="form-control"  name = "selectFilter2" id="selectFilter2">
                    <option>Ключові слова</option>
                    <option>Автор(тільки прізвище)</option>
                    <option>Назва</option>
                    <option>Рік видання</option>
                  </select>
                </div>
                <div class = "col-md-2">
                  <input type = "text" class = "form-control" name = "query" id = "query" placeholder = "Введіть запит"></input>
              </div>
              <div id = "filterBlockSubmit" class = "col-md-2">
                <button class = "btn btn-success btn-block" type = "submit" id = "filterSubmit">Пошук</button>
              </div>
            </form>
        </div>
      </div>
        <br>
        <div class = "container">
            <div class="well">
            <?php
                foreach ($res as $r) {
                  echo <<<R
                  <div class = "row">
                    <div class="list-group-item">
                      <div class="media col-md-3">
                                <h6>$r->author</h6>
                                <h6>$r->title</h6>
                      </div>
                      <div class="col-md-6">
                               <h4 class="list-group-item-heading">Додаткова інформація</h4>
                               <p class="list-group-item-text">
                                  $r->info
                               </p>
                               <h4 class="list-group-item-heading">Тип дисертації</h4>
                               <p class="list-group-item-text">
                                  $r->speciality
                               </p>
                      </div>
                      <div class="col-md-3 text-center">
                            $r->download
                      </div>
                    </div>
                  </div>
R;
                }
                echo $res->links();
             ?>
           </div>
        </div>
        <div id = "anchor">
             <span id = "anchorUp" class="glyphicon glyphicon-circle-arrow-up"></span>
        </div>
    </body>
</html>
