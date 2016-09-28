<?php

session_start();
if(!isset($_SESSION['userID'])){
   header("location:index.php");
}
include 'db.php';
$userid = $_SESSION['userID'];
?>
<html>
<head>
      <title>Home : Project Alpha</title>
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body class="blue darken-4">
    <script type="text/javascript" src="./js/jquery.min.js"></script>
    <script type="text/javascript" src="./js/materialize.min.js"></script>
<div class="navbar-fixed">
<nav>
    <div class="nav-wrapper amber darken-1">
      <a href="#" class="brand-logo">&nbsp;Project Alpha : Home</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="main.php">Home</a></li>
        <li><a href="logout.php">Logout </a></li>
      </ul>
    </div>
</nav>
</div>
<br>
<br>
<div class="container center-align">
    <div class="row">
         <div class="col s12">
           <div class="card-panel white">
             <table class="highlight centered">
                     <thead>
                       <tr>
                           <th data-field="ip">IP</th>
                           <th data-field="browser">Browser</th>
                           <th data-field="version">Browser Version</th>
                           <th data-field="os">OS</th>
                           <th data-field="date">Date</th>
                           <th data-field="time">Time</th>
                       </tr>
                     </thead>
                     <tbody>
<?php

$conn = new mysqli($servername, $username, $password, $myDatabase);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql="SELECT * FROM user_ip WHERE userid='$userid' ORDER BY created_at DESC";
$rs = $conn->query($sql);
if ($rs->num_rows > 0){
    while($row = $rs->fetch_assoc()) {
                          $ip = $row["ip"];
                          $browser = $row["browser"];
                          $version = $row["version"];
                          $os = $row["os"];
                          $date = $row["created_at"];
                echo "<tr><td>";
                echo $ip;
                echo "</td><td>";
                switch ($browser) {
                 case "Apple Safari" :
                   echo "<img src='./img/safari.png' width='50px' alt='Apple Safari' class='tooltipped' data-position='bottom' data-delay='50' data-tooltip='Apple Safari'></img>";
                   break;
                 case "Mozilla Firefox" :
                   echo "<img src='./img/mozilla.png' width='50px' alt='Mozilla Firefox' class='tooltipped' data-position='bottom' data-delay='50' data-tooltip='Mozilla Firefox'></img>";
                   break;
                 case "Google Chrome" :
                   echo "<img src='./img/chrome.png' width='50px' alt='Google Chrome' class='tooltipped' data-position='bottom' data-delay='50' data-tooltip='Google Chrome'></img>";
                   break;
                 case "Opera" :
                   echo "<img src='./img/opera.png' width='50px' alt='Opera' class='tooltipped' data-position='bottom' data-delay='50' data-tooltip='Opera'></img>";
                   break;
                 case "Netscape" :
                   echo "<img src='./img/netscape.png' width='50px' alt='Netscape' class='tooltipped' data-position='bottom' data-delay='50' data-tooltip='Netscape'></img>";
                   break;
                 case "Internet Explorer" :
                   echo "<img src='./img/internet.png' width='50px' alt='Internet Explorer' class='tooltipped' data-position='bottom' data-delay='50' data-tooltip='Internet Explorer'></img>";
                   break;
                 default:
                    echo $browser;
                }
                echo "</td><td>";
                echo $version;
                echo "</td><td>";
                switch ($os) {
                case "Mac" :
                  echo "<img src='./img/osx.png' width='50px' alt='Mac OSX' class='tooltipped' data-position='bottom' data-delay='50' data-tooltip='Mac OSX'></img>";
                  break;
                case "Linux" :
                  echo "<img src='./img/linux.png' width='50px' alt='Linux' class='tooltipped' data-position='bottom' data-delay='50' data-tooltip='Linux'></img>";
                  break;
                case "Windows" :
                  echo "<img src='./img/win.png' width='50px' alt='Windows' class='tooltipped' data-position='bottom' data-delay='50' data-tooltip='Windows'></img>";
                  break;
                default:
                  echo $os;
                }
                echo "</td><td>";
                echo date('M j Y', strtotime($date));;
                echo "</td><td>";
                echo date('g:i A', strtotime($date));
                echo "</td></tr>";
    }
}
else{
      echo "<h4>No records</h4><br>";
    }
?>
                     </tbody>
                   </table>
           </div>
         </div>
       </div>

</div>
</body>

</html>