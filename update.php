
<?php
session_start();
require_once "db_connect.php";
include "file_upload.php";

$id = $_GET['animal_id'];
$result = mysqli_query($connect, "SELECT * FROM animal WHERE animal_id = '$id'");
$row = mysqli_fetch_assoc($result);

if(isset($_POST["edit"])){
  $image = $_POST["image"];
  $name = $_POST["name"];
  $type = $_POST["type"];
  $size = $_POST["size"];
  $age = $_POST["age"];
  $gender = $_POST["gender"];

    $sql = "UPDATE animal SET 
    image = '$image',
     name = '$name',
     type = '$type',
      size = '$size',
       age = '$age',
      gender = '$gender' WHERE animal_id = '$id'";

    if(mysqli_query($connect, $sql)){
      echo "<h1 class='bg-warning text-center'>Record updated successfully</h1>";
      header("refresh: 3; url = dashboard.php");
    } else {
      echo "Error updating record: " . mysqli_error($connect);
    }
}

$sql = "SELECT * FROM user WHERE user_id = {$_SESSION["adm"]}";
$result = mysqli_query($connect, $sql);
if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  
} else {
  echo "No results";
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
      <img src="images/<?= $row["picture"]?>" alt="" width="50" height="50" class="border border-4 border-success-subtle rounded">
      <a class="text-success fw-bold fs-5" style="text-decoration: none;"><?= $row["email"] ?></a>
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
          <a class="nav-link text-success fs-5" href="senior.php?senior">Senior Animals</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-success fs-5" href="logout.php?logout">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>





    
<div class="container my-5 border border-5 rounded-5 border-warning-subtle" style="background-color: #56A3A6;">
  <form method="post" class="d-flex flex-column align-items-center my-5 text-light fs-1">
    <label for="image">image</label>
    <input class="rounded-3 border border-3" style="width: 80%; height:50px; font-size: 22px; color: #DB504A;" type="text" name="image" value="<?= $row["image"] ?>">
  <br>
    <label for="name">name</label>
    <input class="rounded-3 border border-3" style="width: 80%; height: 50px;font-size: 22px; color: #DB504A"  type="text" name="name" value="<?= $row["name"] ?>">
  <br>
    <label for="type">type</label>
    <input class="rounded-3 border border-3" style="width: 80%; height: 50px;font-size: 22px; color: #DB504A"   type="text" name="type" value="<?= $row["type"] ?>">
  <br>
    <label for="size">size</label>
    <input class="rounded-3 border border-3" style="width: 80%; height: 50px;font-size: 22px; color: #DB504A"  type="text" name="size" value="<?= $row["size"] ?>">
  <br>
  <label for="age">age</label>
    <input class="rounded-3 border border-3" style="width: 80%; height: 50px;font-size: 22px; color: #DB504A"   type="text" name="age" value="<?= $row["age"] ?>">
  <br>
    <label for="gender">gender</label>
    <input class="rounded-3 border border-3" style="width: 80%; height: 50px;font-size: 22px; color: #DB504A"   type="text" name="gender" value="<?= $row["gender"] ?>">
  <br>
    
    <input class="btn btn-warning fs-3 w-25 text-dark" type="submit" name="edit" value="Edit">
</form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
