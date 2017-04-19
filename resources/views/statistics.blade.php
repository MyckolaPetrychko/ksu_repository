<html>
  <head>
      @include('header')

      <title>Статистика</title>
      <script type="text/javascript" src = "js/statistics.js"></script>
  </head>
  <body>
    @include('common')

    <div class = "container">
      <div id = "statistics">
        <div class = "row">
          <div id = "repoInfo">
            <h3>Загальна кількість дисертацій: <b id = "common"></b></h3>
          </div>
        </div>
        <div id = "pieCon">
            <canvas id="pieRepo" width="300" height="300"></canvas>
        </div>
        <div id = "barYearCon">
          <canvas id="barYearRepo" width="300" height="300"></canvas>
        </div>
      </div>
    </div>
  </body>
</html>
