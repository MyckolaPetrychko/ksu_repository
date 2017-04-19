<html lang="{{ config('app.locale') }}">
    <head>
        @include('header')
        <title>Адмін</title>
       <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    </head>
    <body>
      @include('common')
          <hr>
          <div class="container bootstrap snippet">
              <div class="row">
                  <div class="col-lg-12">
                      <div class="main-box no-header clearfix">
                          <div class="main-box-body clearfix">
                              <div class="table-responsive">
                                  <table class="table user-list">
                                      <thead>
                                          <tr>
                                          <th><span>User</span></th>
                                          <th><span>Email</span></th>
                                          <th>&nbsp;</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                          $role = array();
                                          foreach($roles as $r){
                                              $role[$r['id']] = $r['type'];
                                          }

                                          foreach($users as $u){
                                            $t = $role[$u->type];
                                            echo <<<HTML
                                            <tr>
                                                <td>
                                                    <span>$u->login</span>
                                                </td>
                                                <td><span>$t</span></td>
                                                <td>  <a href="#">$u->email</a></td>
                                            </tr>
HTML;
                                          }
                                         ?>
                                      </tbody>
                                  </table>
                                  <?php echo ($users->links()); ?>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

        <div class = "container">
            <div class = "row">
              @if (count($errors) > 0)
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
              @endif
            </div>
            <div class = "row">
                <?php
                  if (isset($info)){
                        echo "<div class='alert alert-success'>
                        {$info}
                        </div>";
                  }
                 ?>
            </div>
            <div class = "row">
              <h2>Додати користувача</h2>
              <form action = "/admin/adduser" method = "post">
                {{ csrf_field() }}
                <div class="form-group"> <!-- Name field -->
              		<label class="control-label " for="login">Name</label>
              		<input class="form-control" id="login" name="login" type="text" required/>
              	</div>
                <div class="form-group"> <!-- Name field -->
              		<label class="control-label " for="name">Email</label>
              		<input class="form-control" id="email" name="email" type="email" required/>
              	</div>
                <div class="form-group"> <!-- Name field -->
              		<label class="control-label " for="password">Password</label>
              		<input class="form-control" id="password" name="password" type="password" required/>
              	</div>
                <div class="form-group"> <!-- Radio group !-->
                		<label class="control-label">Type</label>
                		<div class="radio">
                		  <label>
                			<input type="radio" name="type" value="admin"  required>
                			Admin
                		  </label>
                		</div>
                		<div class="radio">
                		  <label>
                			<input type="radio"  name="type" value="user" required>
                			User
                		  </label>
                		</div>
                	</div>

                	<div class="form-group"> <!-- Submit button !-->
                		<button class="btn btn-primary " name="submit" type="submit">Submit</button>
                	</div>
                </div>
              </form>
              <div class = "row">
                <h2>Додати новий тип дисертації</h2>
                <form action = "/admin/addnewdissert" method = "post">
                  {{ csrf_field() }}
                  <div class="form-group"> <!-- Name field -->
                    <label class="control-label " for="name">Name</label>
                    <input class="form-control" id="name" name="name" type="text" required/>
                  </div>
                  <div class="form-group"> <!-- Name field -->
                    <label class="control-label " for="code">Code</label>
                    <input class="form-control" id="code" name="code" type="text" placeholder = "For example: 05.13.23" required/>
                  </div>
                    <div class="form-group"> <!-- Submit button !-->
                      <button class="btn btn-primary " name="submit" type="submit">Submit</button>
                    </div>
                  </div>
                </form>
            </div>
          </div>


        </div>
 </body>
</html>
