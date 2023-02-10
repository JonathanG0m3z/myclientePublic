<?php
//conecccion a la base de datos
$con = mysqli_connect("localhost","root","");

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }else{
    $db="myclientedb";
  }
mysqli_select_db($con,$db);
    $con->query("SET NAMES 'utf8'");
?>