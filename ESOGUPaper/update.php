<?php
  session_start();
  include 'dbh.php';
  $instance = ConnectDb::getInstance();
  $conn = $instance->getConnection();

if(isset($_POST['sub'])){

    $nam = strtolower($_POST['fname']);
    $phn =  $_POST['phn'];
    $rid = $_SESSION['id'];
    $date = $_POST['dob'];

    $nsql = "UPDATE dbo.Users1 SET name= '$nam', DOB= '$date',phone= '$phn' WHERE id='$rid'";
    $result = sqlsrv_query($conn,$nsql);
    header("Location: account.php");
   }
?>
