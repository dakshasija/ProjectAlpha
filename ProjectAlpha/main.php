<?php

session_start();

if(!isset($_SESSION['userID'])){
   header("location:index.php");
}

 $pscore = 'NA';
 $psentiment = 'NA';
 $ptopic = 'NA';
 $nscore = 'NA';
 $nsentiment = 'NA';
 $ntopic = 'NA';
 $sentiment = 'NA';
 $score = 'NA';
function sluggify($url)
{
    $url = strtolower($url);
    $url = strip_tags($url);
    $url = stripslashes($url);
    $url = html_entity_decode($url);
    $url = str_replace('\'', '', $url);
    $match = '/[^a-z0-9]+/';
    $replace = '+';
    $url = preg_replace($match, $replace, $url);
    $url = trim($url, '-');
    return $url;
}

if(isset($_POST['inputText'])){

 $text = $_POST['inputText'];
 $textURL = sluggify($text);
 $apiURL = 'https://api.havenondemand.com/1/api/sync/analyzesentiment/v1?text=' . $textURL . '+%3C3&apikey=7cb8c3d6-1f57-4525-b368-8cab997adf85';
 $curl = curl_init();
 curl_setopt_array($curl, array(
     CURLOPT_RETURNTRANSFER => 1,
     CURLOPT_URL => $apiURL
 ));
 curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
 $resp = curl_exec($curl);
 if(!curl_exec($curl)){
     die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
 }
 curl_close($curl);

 $data = json_decode($resp);

 $sentiment = $data->aggregate->sentiment;
 $score = $data->aggregate->score;


if (isset($data->positive[0]->score)){
  $pscore = $data->positive[0]->score;
  $psentiment = $data->positive[0]->sentiment;
  $ptopic = $data->positive[0]->topic;
}
if (isset($data->negative[0]->score)){
   $nscore = $data->negative[0]->score;
   $nsentiment = $data->negative[0]->sentiment;
   $ntopic = $data->negative[0]->topic;
}
}
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
        <li><a href="history.php">History</a></li>
        <li><a href="logout.php">Logout </a></li>
      </ul>
    </div>
</nav>
</div>
<div class="container">
<br>
<div class="row">
<div class="col s12">
<div class="card-panel">
<form action="#" method="POST">
<div class="row">
        <div class="input-field col s12">
          <textarea id="textarea1" name="inputText" class="materialize-textarea"></textarea>
          <label for="textarea1">Enter text to analyze...</label>
        </div>
</div>
<div class="row center-align">
<button class="btn waves-effect waves-light light-blue" type="submit" name="action">Submit
    <i class="material-icons right">send</i>
  </button>
</div>
</form>
<br>
<br>
<h5 class="center-align"><u>Analysis</u></h5>
<br>
     <table class="highlight centered">
        <thead>
          <tr>
              <th data-field="id">Analysis</th>
              <th data-field="key">Key</th>
              <th data-field="value">Value</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>Positive</td>
            <td>Sentiment</td>
            <td><?php echo $psentiment; ?></td>
          </tr>
          <tr>
            <td></td>
            <td>Topic</td>
            <td><?php echo $ptopic; ?></td>
          </tr>
          <tr>
            <td></td>
            <td>Score</td>
            <td><?php echo $pscore; ?></td>
          </tr>
          <tr>
            <td>Negative</td>
            <td>Sentiment</td>
            <td><?php echo $nsentiment; ?></td>
          </tr>
          <tr>
            <td></td>
            <td>Topic</td>
            <td><?php echo $ntopic; ?></td>
          </tr>
          <tr>
            <td></td>
            <td>Score</td>
            <td><?php echo $nscore; ?></td>
          </tr>
          <tr>
            <td>Aggregate</td>
            <td>Sentiment</td>
            <?php
                      echo '<td ';
                      if ($sentiment == 'positive'){
                        echo 'class="teal accent-4">';
                      }
                      else if($sentiment == 'negative'){
                        echo 'class="red lighten-1">';
                      }
                      else {
                        echo 'class="lime accent-2">';
                      }
                      echo $sentiment;
             ?>
            </td>
          </tr>
          <tr>
            <td></td>
            <td>Score</td>
            <?php
                                echo '<td ';
                                if ($sentiment == 'positive'){
                                  echo 'class="teal accent-4">';
                                }
                                else if($sentiment == 'negative'){
                                  echo 'class="red lighten-1">';
                                }
                                else {
                                  echo 'class="lime accent-2">';
                                }
                                echo $score;
                                ?></td>
          </tr>

        </tbody>
      </table>
</div>
</div>
</div>
</div>
</body>
</html>