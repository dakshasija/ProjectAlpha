<?php

session_start();

if(isset($_SESSION['userID'])){
   header("location:main.php");
}
?>


<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="css/style.css"  media="screen,projection"/>
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
       
      <script>
        function validateForm(){
            var x=document.forms["myForm"]["pass"].value;
            if(x==null || x==""){
                alert("This field can't be left empty!!");
                return false;
            }
            var textLength = x.length;
            if(textLength<6){
                $(".message").fadeIn();
                return false;
            }
            
        }
        </script>
        
    </head>

    <body class="blue darken-4">
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="js/jquery.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>

        <h2 class="center-align">Project Alpha</h2>
        <div class="row" style="padding-right:75px;">
            <div class="col s3 offset-s9 grey darken-4 login" id="signUp">
                <div class="row">
                    <form name="myForm" onsubmit="return validateForm()" class="col12" action="signup.php" method="POST">
                        <div class="row">
                            <div class="col s12 center-align">
                                <h4>Sign Up</h4>
                            </div>
                            <hr>
                            <div class="input-field col s12">
                                <input id="user_name" type="email" class="validate" name="email">
                                <label for="user_name" class="white-text">E-Mail</label>
                            </div>
                            <div class="input-field col s12 ">
                                <input id="pwd" type="password" name="pass" class="validate" name="pass">
                                <label for="user_name" class="white-text">Password</label>
                                
                            </div>
                            <div class="input-field col s12 center-align red-text message">Password must be atleast 6 characters!!</div>
                            <div class="col s12 center-align">
                                <button class="btn waves-effect waves-light blue" type="submit" name="action">Submit
                                  </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col s3 offset-s9 grey darken-4 login" id="logIn">
                <div class="row">
                    <form class="col12" action="login.php" method="POST">
                        <div class="row">
                            <div class="col s12 center-align">
                                <h4>Sign In</h4>
                            </div>
                            <hr>
                            <div class="input-field col s12">
                                <input id="user_name" type="text" name="email" class="validate">
                                <label for="user_name" class="white-text">E-Mail</label>
                            </div>
                            <div class="input-field col s12 ">
                                <input id="pwd" type="password" name="pwd" class="validate">
                                <label for="user_name" class="white-text">Password</label>        
                            </div>
                            <div class="col s12 center-align">
                                <button class="btn waves-effect waves-light blue" type="submit" name="action">Log In
                                                                  </button>
                            </div>
                            <br>
                            <div class="col s12 center-align">
                                <a class="white-text" href=" " target="_blank">Forgot Password?</a>
                            </div>
                            <div class="col s12 center-align">
                                <p style="display:inline;">New User?</p><a id="hlSignup" class="white-text apple">SignUp</a>
                            </div>
                        </div>
                    </form>
                </div>
                    
            </div>
        </div>
        <script type="text/javascript" src="js/app.js"></script>
    </body>
      
  </html>
        