<?php
    session_start();

    if(isset($_SESSION["user"])){
      header("Location: home.php");
    }

    if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
      header("Location: login.php");
    }
    
    include "db_connect.php";
  include "file_upload.php";
 
$sql = "SELECT * FROM user WHERE user_id = {$_SESSION["adm"]}";
$result = mysqli_query($connect, $sql);
$adminRow = mysqli_fetch_assoc($result); 
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
      <img src="images/<?= $adminRow["picture"]?>" alt="" width="50" height="50" class="border border-4 border-success-subtle rounded">
      <a class="text-success fw-bold fs-5" style="text-decoration: none;"><?= $adminRow["email"] ?></a>
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
          <a class="nav-link text-success fs-5" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-success fs-5" href="create.php?create">Upload pet</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link text-success fs-5" href="logout.php?logout">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<?php
   //DELETE BUTTON
if (isset($_POST['delete'])) {
  $id_to_delete = $_POST['id_to_delete'];

  $sql = "DELETE FROM animal WHERE animal_id = '$id_to_delete'";

  if (mysqli_query($connect, $sql)) {
      echo "<h1 class='bg-warning text-center'>Record deleted</h1>";

      header("refresh: 3; url = dashboard.php");
  } else {
      echo "<h1 class='bg-warning text-center'>Error deleting record:</h1> " . mysqli_error($connect);
  }
}


$sqlAnimals = "SELECT * FROM animal";
$resultAnimals = mysqli_query($connect, $sqlAnimals);

$layout = "";

echo "
          <h1 class='text-center mt-5 text-light'> Welcome Admin </h1>
          <div class='container'>
          <div class='row justify-content-center'>";


if(mysqli_num_rows($resultAnimals) > 0){
  while ($animalRow = mysqli_fetch_assoc($resultAnimals)){

    
    $layout .= "
    
    
    
    <div class='col-sm-12 col-md-5 col-lg-4 col-xl-4 col-xxl-3'>
    
    
    <div class='card mt-5 text-light' style='width: 18rem; background-color: #4F6D7A'>
    <img src='{$animalRow['image']}' class='card-img-top' alt='...' width= '200' >
    <div class='card-body' style='background-color: #084C61'>
      <h5 class='card-title'><strong>Name:</strong> {$animalRow['name']}
      <p class='card-text'></strong>Type:</strong> {$animalRow['type']}
    </div>
    <ul class='list-group list-group-flush'>
      <li class='list-group-item text-light' style='background-color: #4F6D7A'><strong>Size:</strong> {$animalRow['size']}</li>
      <li class='list-group-item text-light' style='background-color: #4F6D7A'><strong>Age:</strong> {$animalRow['age']}</li>
      
 
    </ul>
    <div class='card-body' style='background-color: #084C61'>
      <a href='details.php?animal_id={$animalRow["animal_id"]}' class='btn btn-warning'>Show Details</a>
      <a href='update.php?animal_id={$animalRow["animal_id"]}' class='btn btn-danger'>Edit</a>
      <form method='post' style='display: inline-block;'>
        <input type='hidden' name='id_to_delete' value='{$animalRow["animal_id"]}'>
        <input type='submit' name='delete' value='Delete' class='btn btn-light'>
      </form>
    </div>
  </div>
  </div>";
  }
  echo $layout;
}
else {
  $layout = "No results";
}

echo "</div></div>";
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>