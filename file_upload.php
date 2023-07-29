<?php
function fileUpload($images){

  if($images["error"] == 4){
    $imageName = "avatar.png";
    $message= "no picture uploaded";
  }else{
    $checkIfImage = getimagesize($images["tmp_name"]);
    $message = $checkIfImage ? "Ok" : "Not an image";
  }


if($message == "Ok"){
  $ext = strtolower(pathinfo($images["name"],PATHINFO_EXTENSION));
  $imageName = uniqid("" ). "." . $ext;
  $destination = "images/{$imageName}";
  move_uploaded_file($images["tmp_name"], $destination);

}elseif($message == "Not an image"){
    $imageName = "avatar.png";
    $message = "The file you selected is not an image";
}

return [$imageName, $message];
}