<div id="navbar-green">
    <nav class="navbar navbar-ct-green" role="navigation">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a id = "home" class="navbar-brand" href="/">
            <i class = "pe-7s-home">KSU</i>
          </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id = "navbarCollapse">
            <ul class="nav navbar-nav navbar-right" >
              <li>
                    <a id = "stat" href="/statistics">
                          <i class="pe-7s-graph1"></i>
                          <p>Статистика</p>
                     </a>
              </li>
              @if (!Auth::check())
                <li>
                      <a id = "login" href="/login">
                            <i class="pe-7s-angle-right"></i>
                            <p>Увійти</p>
                       </a>
                </li>
              @else
                    <li>
                          <a id = "login" href="/profile">
                                <i class="pe-7s-user"></i>
                                <p>Профіль</p>
                           </a>
                    </li>
                    <?php
                        $arr = Auth::user();
                        $type = $arr->toArray()['type'];
                        if ($type == 1){
                            echo '<li>
                                  <a id = "login" href="/adminpanel">
                                        <i class="pe-7s-users"></i>
                                        <p>Адмін панель</p>
                                   </a>
                            </li>';
                        }
                     ?>
                     <li>
                           <a id = "login" href="/dashboard">
                                 <i class="pe-7s-config"></i>
                                 <p>Консоль</p>
                            </a>
                     </li>
                     <li>
                           <a id = "login" href="/logout">
                                 <i class="pe-7s-angle-left"></i>
                                 <p>Вийти</p>
                            </a>
                     </li>
              @endif
           </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
</div>
