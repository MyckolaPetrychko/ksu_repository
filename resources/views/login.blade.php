<html lang="{{ config('app.locale') }}">
    <head>
        @include('header')

        <title>Увійти</title>
    </head>
    <body>
      @include('common')
      <div class="container">
        <div id = "mainContent" class="col-md-12">
          <div id = "loginColumn">

            <div class="container">
              <div class="row" style="margin-top:60px">

                  <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                    <form action="/login/authenticate" method = "post">
                       {{ csrf_field() }}
                       @if (isset($error))
                       <div class="alert alert-danger">
                             <strong>{{ $error }}</strong>
                       </div>
                       @endif
                      <fieldset>
                        <h2>Please Sign In</h2>
                        <hr class="colorgraph">
                        <div class="form-group">
                                <input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address"></input>
                        </div>
                        <div class="form-group">
                                <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password"></input>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" id = "rememberMe" name = "remember">Remember me</input>
                          </label>
                        </div>
                        <hr class="colorgraph">
                        <div class="row">
                          <div class="col-xs-6 col-sm-6 col-md-6">
                                        <input id = "loginSubmit" class="btn btn-lg btn-success btn-block" type = "submit" value = "Sign in"></input>
                          </div>
                        </div>
                      </fieldset>
                    </form>
                </div>
              </div>
            </div>
          </div>

    </body>
</html>
