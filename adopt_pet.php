<?php
require_once "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST["user_id"];
    $pet_id = $_POST["pet_id"];
    $adoption_date = date('Y-m-d');

    $sql = "INSERT INTO pet_adoption (user_id, pet_id, adoption_date) 
            VALUES ('$user_id', '$pet_id', '$adoption_date')";

    if (mysqli_query($connect, $sql)) {
        echo "Successfully adopted pet!";
        
        header("Refresh:3; url=home.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connect);
    }
}
?>
