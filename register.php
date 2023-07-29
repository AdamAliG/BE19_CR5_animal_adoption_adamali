<?php
session_start();
include "db_connect.php";
include "file_upload.php";
include "functions.php";

if(isset($_SESSION["adm"])){
  header("Location:dashboard.php");
}

if(isset($_SESSION["user"])){
  header("Location:home.php");
}

$error = false;

$firstname = $lastname = $email = $date_of_birth = "";
$firstnameError = $lastnameError = $dateError = $emailError=$passError= "";


if(isset($_POST["sign-up"])){
  $firstname=cleanInput($_POST["firstname"]);
  $lastname=cleanInput($_POST["lastname"]);
  $email=cleanInput($_POST["email"]);
  $password=cleanInput($_POST["password"]);
  $date_of_birth = cleanInput($_POST["date_of_birth"]);
  $images= fileUpload($_FILES["images"]);
  if(empty($firstname)){
    $error = false;
    $firstnameError= "enter first name";

  }elseif (strlen($firstname) < 3){
    $error = true;
    $firstnameError = "Name must have at elast 3 characters.";
  }elseif(!preg_match("/^[a-zA-Z\s]+$/", $firstname)){
    $error= true;
    $firstnameError = "Name must contain only letters and spaces";
  }

  if(empty($lastname)){
    $error = false;
    $lastnameError= "enter last name";

  }elseif (strlen($lastname) < 3){
    $error = true;
    $lastnameError = "Name must have at least 3 characters.";
  }elseif(!preg_match("/^[a-zA-Z\s]+$/", $lastname)){
    $error= true;
    $lastnameError = "Name must contain only letters and spaces";
  }

  if(empty($date_of_birth)){
    $error= true;
    $dateError = "date of birth cant be empty";
  }

  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $error = true;
    $emailError = "Please enter a valid email address";
  }else {
    $query = "SELECT email FROM user WHERE email = '$email'";
    $result = mysqli_query($connect, $query);
    if(mysqli_num_rows($result) !=0){
      $error = true;
      $emailError = "Provided Email is already taken";
    }
  }

  if(empty($password)){
    $error = true;
    $passError = "Password cant be empty!";
  }elseif(strlen($password) < 5){
    $error = true;
    $passError = "Password must have at least 5 characters";
  }

  if(!$error){
    $password = hash("sha256", $password);
    $sql = "INSERT INTO user(first_name, last_name, password, date_of_birth, email, picture) VALUES ('$firstname','$lastname','$password','$date_of_birth','$email','$images[0]')";
  
$result = mysqli_query($connect, $sql);

  if ($result){
    echo "<div class='alert alert-success'>
    <p> New account has been created, $images[1]</p>
    </div>";
  } else {
    echo "<div class='alert alert-danger'>
    <p>Something went wrong, please try again later</p>
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
  <title>animal adoption</title>
</head>
<body>
  <div class="container">
    <h1 class="text center">Sign Up</h1>
    <form method="post" autocomplete="off" enctype="multipart/form-data">
      <div>
        <label for="firstname" class="form-label">firstname</label>
        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First name" value="<?= $firstname ?>">
        <span class="text-danger"><?= $firstnameError ?></span>
      </div>

      <div>
      <label for="lastname" class="form-label">lastname</label>
        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last name" value="<?= $lastname ?>">
        <span class="text-danger"><?= $lastnameError ?></span>
      </div>

      <div>
      <label for="date" class="form-label">Date of birth</label>
        <input type="date" class="form-control" id="date" name="date_of_birth" value="<?= $date_of_birth ?>">
        <span class="text-danger"><?= $dateError ?></span>
      </div>

      <div>
      <label for="image" class="form-label">Profile picture</label>
        <input type="file" class="form-control" id="images" name="images" value="<?= $images ?>">
        
      </div>

      <div>
      <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Email address" value="<?= $email ?>">
        <span class="text-danger"><?= $emailError ?></span>
      </div>

      <div>
      <label for="password" class="form-label">password</label>
        <input type="password" class="form-control" id="password" name="password" value="<?= $password ?>">
        <span class="text-danger"><?= $passError ?></span>
      </div>

      <button name="sign-up" type="submit" class="btn btn-primary"> Create Account</button>

      <span>you have an account already? <a href="login.php">sign in here</a></span>
    </form>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>