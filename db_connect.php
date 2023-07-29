<?php
$userName = "root";
$hostName = "localhost";
$password = "";
$dbName = "be19_cr5_animal_adoption_adamali";


$connect = mysqli_connect($hostName, $userName,  $password, $dbName);


if (!$connect) {
  die ("Connection failed");
}