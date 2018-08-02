
<?php
include 'variables.php';


$conn = mysqli_connect($Endpoint, $UserDB , $PswDB, $DBName);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
else{
    $sql = "DELETE FROM PHOTO WHERE path_s3='".$_POST["path"]."'";
    if ($conn->query($sql) === TRUE) {
        $s3delete = 'aws s3 rm s3://rede-s3-lab/' . $_POST["path"];
        $output = shell_exec($s3delete);
        $cmd = 'sudo rm /usr/share/nginx/html/bucket/' . $_POST["path"];
        $output1 = shell_exec($cmd);
        $sync = shell_exec('aws s3 sync /usr/share/nginx/html/bucket s3://rede-s3-lab --delete');
        header('Location: index.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
  $conn->close();
}
?>