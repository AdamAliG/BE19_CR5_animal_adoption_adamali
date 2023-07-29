<?php
require_once "db_connect.php";
include "file_upload.php";
$id = $_GET["animal_id"];

$sql = "SELECT *FROM animal WHERE animal_id = $id";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <title>Document</title>
</head>
<body style="background-color: #56A3A6;">
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
  <a class="navbar-brand" href="#">
 <?php $results = mysqli_query($connect, "SELECT * FROM user");
$rows = mysqli_fetch_assoc($results);?>
      <img src="images/<?= $rows["picture"]?>" alt="" width="50" height="50" class="border border-4 border-success-subtle rounded">
      <a class="text-success fw-bold fs-5" style="text-decoration: none;"><?= $rows["email"] ?></a>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link active" aria-current="page"></a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-success fs-5" aria-current="page" href="home.php">Home</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link text-success fs-5" href="logout.php?logout">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<?php

echo "
<div class='container'>
<div class='card mt-5 m-auto border border-warning border-2 rounded-4 text-light fw-semibold' style='background-color: style='background-color: #084C61';'>
<img src= '{$row["image"]}' width= '200' class='card-img-top' alt='...'>
<div class='card-body' style='background-color: #084C61'>
  <h5 class='card-title fs-2'>Name: {$row["name"]}</h5>
  <h2 class='card-text fs-3'>type: {$row["type"]}</h2>
</div>
<ul class='list-group list-group-flush'>
<li class='list-group-item text-light fs-5' style='background-color: #084C61 !important; border-bottom: 2px solid #084C61'>Size: {$row["size"]} </li>
<li class='list-group-item text-light fs-5' style='background-color: #084C61 !important; border-bottom: 2px solid #084C61'>Type: {$row["type"]}</li>
<li class='list-group-item text-light fs-5' style='background-color: #084C61 !important; border-bottom: 2px solid #084C61'>age {$row["age"]}</li>
<li class='list-group-item text-light fs-5' style='background-color: #084C61 !important; border-bottom: 2px solid #084C61'>gender: {$row["gender"]}</li>

</ul>
<div class='card-body' style='background-color: #084C61'>
<a href='{$_SERVER['HTTP_REFERER']}' class='btn btn-warning'>Return to previous page</a>

  
     
</div>
</div>
</div>";
      
?>