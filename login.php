<?php
session_start();
include "db_connect.php";

include "functions.php";

$email = $passError = $emailError = "";

if(isset($_POST["login"])){
  $email = cleanInput($_POST["email"]);
  $password = cleanInput($_POST["password"]);
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $error = true;
    $emailError = "Please enter a valid email address";
  }

  if (empty ($password)){
    $error = true;
    $passError = "Password cant be empty";
  }

  if(!$error){
    $password = hash("sha256", $password);
    $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result) ==1){
      if($row["status"] == "user"){
        $_SESSION["user"] = $row["user_id"];
        header("Location: home.php");
        
      }else{
        $_SESSION["adm"] = $row["user_id"];
        header("Location: dashboard.php");
      }
    }else {
      echo "<div class='allert alert-danger'>
      <p>Wrong credentials, please try again </p>
      </div>";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <title>Login</title>
</head>
<body>
<div class="container">
    <h1 class="text center">Login page</h1>
    <form method="post">
      <div>
        <label for="email" class="form-label">Email:</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="email" value="<?= $email ?>">
        <span class="text-danger"><?= $emailError ?></span>
      </div>

      <div>
      <label for="password" class="form-label">password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="password" value="<?= $password ?>">
        <span class="text-danger"><?= $passError ?></span>
      </div>
      <button name="login" type="submit" class="btn bt-primary">Login</button>

      <span>you dont have an account?<a href="register.php">register here</a></span>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>