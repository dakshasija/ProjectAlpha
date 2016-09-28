<?php
session_start();

include 'getbrowser.php';
include 'db.php';

$ip=$_SERVER['REMOTE_ADDR'];


$ua=getBrowser();
$bname = $ua['name'];
$bversion = $ua['version'];
$os = $ua['platform'];

$conn = new mysqli($servername, $username, $password, $myDatabase);

$remail = $_POST["email"];
$rpass = $_POST["pass"];
$email = strip_tags(stripslashes(mysqli_real_escape_string($conn,$remail)));
$pass = sha1(strip_tags(stripslashes(mysqli_real_escape_string($conn,$rpass))));
$rand = mt_rand(10000,99999);
$time = date("d-m-y",time());

$sql = "INSERT INTO user_details(userid,email,pass) VALUES ('$rand','$email','$pass')";
$sql2 = "INSERT INTO user_ip(userid,ip,browser,version,os) VALUES ('$rand','$ip','$bname','$bversion','$os')";

$conn->query($sql);
$conn->query($sql2);
$_SESSION['userID']= $userid;
header("location:main.php");


$conn->close();
?>