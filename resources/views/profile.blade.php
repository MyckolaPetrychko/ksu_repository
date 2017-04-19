<html lang="{{ config('app.locale') }}">
    <head>
      @include('header')

      <title>Профіль</title>
    </head>
    <body>

      @include('common')

      <div class = "container">
          <div class = "row">
              <?php
                $arr = Auth::user();
                echo 'Логін: ' . $arr['login'] . '<br>';
                echo 'Пошта: ' . $arr['email'] . '<br>';
               ?>
               <div class="container">
               <div id="passwordreset" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                   <div class="panel panel-info">
                       <div class="panel-heading">
                           <div class="panel-title">Update password</div>
                       </div>
                       @if (isset($error))
                         <div class="alert alert-danger">
                               <strong>{{ $error }}</strong>
                         </div>
                       @endif
                       @if (isset($info))
                         <div class="alert alert-success">
                               <strong>{{ $info }}</strong>
                         </div>
                       @endif
                       <div class="panel-body">
                           <form id="signupform" class="form-horizontal" role="form" action = "/updatepassword" method = "post">
                                {{ csrf_field() }}
                               <div class="form-group">
                                   <label for="email" class=" control-label col-sm-3">Old password</label>
                                   <div class="col-sm-9">
                                       <input type="password" class="form-control" name="old_password" placeholder="Please input your old password">
                                   </div>
                               </div>
                               <div class="form-group">
                                   <label for="email" class=" control-label col-sm-3">New password</label>
                                   <div class="col-sm-9">
                                       <input type="password" class="form-control" name="password" placeholder="create your new password">
                                   </div>
                               </div>
                               <div class="form-group">
                                   <label for="email" class=" control-label col-sm-3">Confirm password</label>
                                   <div class="col-sm-9">
                                       <input type="password" class="form-control" name="password_confirmation" placeholder="confirm your new password">
                                   </div>
                               </div>
                               <div class="form-group">
                                   <!-- Button -->
                                   <div class="  col-sm-offset-3 col-sm-9">
                                       <input id="btn-signup" type="submit" value = "submit" class="btn btn-success"></input>
                                   </div>
                               </div>
                           </form>
                       </div>
                   </div>
               </div>
           </div>
          </div>
      </div>
    </body>
</html>
