<?php
  session_start();
  include 'dbh.php';
  $instance = ConnectDb::getInstance();
  $conn = $instance->getConnection();

if(isset($_POST['subpass'])){

    $oldpass = $_POST['oldp'];
    $newpass =  $_POST['newp'];
    $rid = $_SESSION['id'];

    $psql = "UPDATE dbo.Users1 SET passwd = '$newpass' WHERE id='$rid' AND passwd='$oldpass'";
    $result = sqlsrv_query($conn,$psql);
    header("Location: accountp.php");
}
?>
