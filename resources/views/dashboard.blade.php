<html lang="{{ config('app.locale') }}">
    <head>
      @include('header')

      <title>Консоль</title>

    </head>
    <body>
      @include('common')
      <div class = "container">
          <div class = "row">
            <h1>Додати дисертацію</h1>
            @if (count($errors) > 0)
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif
            <?php
            if (isset($success)){
            echo '<div class="alert alert-success">
                <span>'. $success . '</span>
            </div>';
          }
             ?>
            <form action = "/dashboard/adddisert" method = "post" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="form-group"> <!-- Name field -->
                <label class="control-label " for="author">Автор</label>
                <input class="form-control" id="author" name="author" type="text" required/>
              </div>
              <div class="form-group"> <!-- Name field -->
                <label class="control-label " for="title">Назва</label>
                <input class="form-control" id="title" name="title" type="text" required/>
              </div>
              <div class="form-group"> <!-- Name field -->
                <label class="control-label " for="year">Рік</label>
                <input class="form-control" id="year" name="year" type="text" required/>
              </div>
              <div class="form-group"> <!-- Name field -->
                <label class="control-label " for="info">Додаткова інформація</label>
                <textarea class="form-control" id="info" name="info" type="text" required></textarea>
              </div>
              <div class="form-group"> <!-- Name field -->
                <label class="control-label " for="type1">Тип</label>
                <select class="form-control" id="type1" name="type1" type="text" required>
                  <option selected disabled>Роботи</option>
                  <option value = "Кандидатська">Кандидатська</option>
                  <option value = "Докторська">Докторська</option>
                </select>
                <br>
                <select class="form-control" id="type2" name="type2" type="text" required>
                  <option selected disabled>Дисертації</option>
                  <?php
                    foreach($labels as $l=>$k){
                      echo '<option value = "'. $k . '">'. $k . '</option>';
                    }
                   ?>
                </select>
              </div>
              <div class="form-group"> <!-- Name field -->
                <label class="control-label " for="file">Автореферат</label>
                <input class="form-control" id="file" name="file" type="file" required/>
              </div>
              <div class="form-group"> <!-- Radio group !-->
                <div class="form-group"> <!-- Submit button !-->
                  <input class="btn btn-primary " name="submit" type="submit"></input>
                </div>
              </div>
            </form>
        </div>
      </div>
 </body>
</html>
