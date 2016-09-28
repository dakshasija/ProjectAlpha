 $( document ).ready(function() {
   $("#signUp").hide();
     $(".message").hide();
     
     $(".apple").click(function() {
                      $("#logIn").toggle();
                      $("#signUp").toggle();
                      });
   $(".signup").click(function() {
                      $("#signUp").toggle();
                      $("#logIn").toggle();
                      });
    
});