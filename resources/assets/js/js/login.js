$(function(){
  $('#login').click(function(){



    //$("#loginColumn").load("/views/login.html");
    $("#loginColumn").show();
    $("#repoContent").html("");
    $("#statistics").hide();
    $("#filter").html("");

    $('#loginSubmit').click(function(){
      var email = $('#email').val();
      var pass = $('#password').val();
      
        //$.cookie("name", "value");
    });

  /*  var request = $.ajax({
      url: "/controllers/login.php",
      type: "get",
      data: "test"
    });

    request.done(function(response, textStatus, jqXHR){
      $("#mainContent").html(response);
    });*/

  });



});
