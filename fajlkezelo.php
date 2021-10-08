<?php
function faljkezelo(){
    $target_dir = "feltoltesek/";
    $target_file = $target_dir . basename($_FILES["auto_kep"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        return null;
    } else {
        if (move_uploaded_file($_FILES["auto_kep"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["auto_kep"]["name"])). " has been uploaded.";
            return $target_file;
        } else {
            echo "Sorry, there was an error uploading your file.";
            return null;
        }
    }

}