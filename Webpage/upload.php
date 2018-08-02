<?php

include 'variables.php';

date_default_timezone_set('UTC-06:00');

// Create connection
$conn = mysqli_connect($Endpoint, $UserDB , $PswDB, $DBName);
$hoy = date("Y-m-d H:i:s");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
else{
  $target_dir = "images/";
  $target_file = $target_dir . basename($_FILES["fileUpload"]["name"]);
  echo $target_file;
  if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
    $sql = "INSERT INTO PHOTO (path_s3,date_upload) VALUES ('images/". basename( $_FILES["fileUpload"]["name"])."','$hoy')";
    if ($conn->query($sql) === TRUE) {
        $output = shell_exec('aws s3 sync /usr/share/nginx/html/bucket/images s3://rede-s3-lab/images --delete');
        header('Location: index.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
  } else {
    echo 'Sorry, there was an error uploading your file.';
  }
  $conn->close();
  
}
?>