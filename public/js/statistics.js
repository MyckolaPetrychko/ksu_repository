$(function(){
      setPie();

      function setPie(){
        var request = $.ajax({
          url: "/statistics/dist",
          type: "get"
        });
        request.done(function(response, textStatus, jqXHR){
            pieData = response;
            var ctx = $("#pieRepo");

            var ctx2 = $("#barYearRepo");

            var sum = Object.values(pieData.datasets.data).reduce(add, 0);
            $("#repoInfo #common").html(sum);

            var data = {
                labels: Object.keys(pieData['labels']),
                datasets: [
                    {
                        data: Object.values(pieData.datasets.data),
                        backgroundColor: pieData.datasets.backgroundColor,
                        hoverBackgroundColor: pieData.datasets.hoverBackgroundColor
                    }]
              };
              var myPieChart = new Chart(ctx,{
                type: 'pie',
                data: data,
                options: {
                  responsive: true,
                  maintainAspectRatio: false,
                  animation:{
                      animateScale:true
                  }
                }
              });

            var yearDist = pieData.datasets.yearDistribution.dist;

            var dataForYearBar = {
              labels: Object.keys(yearDist),
              datasets: [
                  {
                      label: "Розподіл дисертацій по роках",
                      backgroundColor: pieData.datasets.yearDistribution.backgroundColor,
                      borderColor: pieData.datasets.yearDistribution.hoverBackgroundColor,
                      borderWidth: 1,
                      data: Object.values(yearDist)
                  }
              ]
            }

            var yearBarChart = new Chart(ctx2, {
              type: 'bar',
              data: dataForYearBar,
              options: {
                responsive: true,
                maintainAspectRatio: false,
                animation:{
                    animateScale:true
                }
              }
          });

        });
      }

      function add(a, b) {
          return parseInt(a) + parseInt(b);
      }

      function convertToObject(arr){
        var result = {};
        for (var i = 0; i < arr.length; i++){
          result[arr[i].key] = arr[i].value;
        }
        return result;
      }
});
