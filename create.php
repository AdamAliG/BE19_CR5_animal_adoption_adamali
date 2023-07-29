<?php
include "file_upload.php";
  include "db_connect.php";
  if(isset($_POST["create"])){
    $image = $_POST["image"];
    $name = $_POST["name"];
    $type = $_POST["type"];
    $size = $_POST["size"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
   

    $sql = "INSERT INTO animal (image, name, type, size, age, gender) VALUES ('$image','$name', '$type','$size', '$age','$gender')";

    if(mysqli_query($connect, $sql)){
      echo "<h1 class='bg-warning text-center'>successfully created!</h1>";
      header("refresh: 3; url = dashboard.php");

    } else {
      echo "error" . mysqli_error($connect);;
    }
  }
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

<div class="container my-5 border border-5 rounded-5 border-warning-subtle" style="background-color: #084C61;">
  <form method="post" class="d-flex flex-column align-items-center my-5 text-light fs-1">


    <label for="name">name</label>
    <input class="rounded-3 border border-3 border-warning" style="width: 80%; height:50px; font-size: 22px; color: #4e1d04;" type="text" name="name">
  <br>
  <label for="image">image</label>
    <input class="rounded-3 border border-3 border-warning" style="width: 80%; height: 50px;font-size: 22px; color: #4e1d04"  type="text" name="image">
  <br>
    <label for="type">type</label>
    <input class="rounded-3 border border-3 border-warning" style="width: 80%; height: 50px;font-size: 22px; color: #4e1d04"  type="text" name="type">
  <br>
    <label for="size">size</label>
    <input class="rounded-3 border border-3 border-warning" style="width: 80%; height: 50px;font-size: 22px; color: #4e1d04"   type="text" name="size">
  <br>
    <label for="age">age</label>
    <input class="rounded-3 border border-3 border-warning" style="width: 80%; height: 50px;font-size: 22px; color: #4e1d04"  type="number" name="age">
  <br>
    <label for="gender">gender</label>
    <input class="rounded-3 border border-3 border-warning" style="width: 80%; height: 50px;font-size: 22px; color: #4e1d04"   type="text" name="gender">
 
    
    <input class="btn btn-warning fs-3 w-50 text-dark" type="submit" name="create" value="Upload Pet">
</form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
