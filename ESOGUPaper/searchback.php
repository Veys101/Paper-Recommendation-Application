<?php
include 'mongodb.php';
if(isset($_POST['submit'])){

  $option = $_POST['textoption'];
  $text =  strtolower($_POST['textoption']);
  $person = $_SESSION['id'];

  $filter = [ 'title' => $option ]; 
  $query = new MongoDB\Driver\Query($filter); 
  $rows = $mongo_conn->executeQuery("Paper.Papers", $query);

  $arr = $rows->toArray();
  $paper = current($arr);

  if (!empty($paper)) {

    while(!empty($paper)){
    
      echo"<form action='paper.php' method='POST'>";
        echo"<div style='color:white'>";
          echo "<input type='submit' name='submit' class='btn btn-outline-info' style='width:100%; text-align: left;display:block; padding-bottom:5px; margin-bottom:5px' value='".$paper->title."'/>";
          echo "<input type='hidden' id='paper_id' name='paper_id' value='".$paper->id."'>";
            //echo "$row->id : $row->title <br>";
        echo"</div>";
      echo"</form>"; 

      $paper = next($arr);
    }
      
  } else {
    
     echo "<h2 style='margin-top:40px;padding-top:0px;color:white;'>Not Found</h2>";
  }

 
}
 ?>