<?php
include 'mongodb.php';

  $per_page_record = 100;  
  
  if (isset($_GET["page"])) {    
      $page  = $_GET["page"];    
  }    
  else {    
      $page=1;    
  }    

  $start_from = ($page-1) * $per_page_record;     

  $query = new MongoDB\Driver\Query([],['skip' => $start_from,'limit' => $per_page_record]); 
   
  $rows = $mongo_conn->executeQuery("Paper.Papers", $query);

  // Get total size of Paper collection
  $stats = new MongoDB\Driver\Command(["dbstats" => 1]);
  $res = $mongo_conn->executeCommand("Paper", $stats);
    
  $stats = current($res->toArray());

  $total_records = $stats->objects;

  $total_pages = ceil($total_records / $per_page_record); 

  foreach ($rows as $row) {
    
    echo"<form action='paper.php' method='POST'>";
      echo"<div style='color:white'>";
        echo "<input type='submit' name='submit' class='btn btn-outline-info' style='width:100%; text-align: left;display:block; padding-bottom:5px; margin-bottom:5px' value='$row->title'/>";
        echo "<input type='hidden' id='paper_id' name='paper_id' value='$row->id'>";
          //echo "$row->id : $row->title <br>";
      echo"</div>";
    echo"</form>"; 
  }


  if($page>=2){   

     echo "<a href='homepage.php?page=".($page-1)."'>  Prev </a>";   
  }       
        
  $pagLink = ""; 
  for ($i=1; $i<=$total_pages; $i++) {   
    if ($i == $page) {   
        $pagLink .= "<a class = 'active' href='homepage.php?page=".$i."'>".$i." </a>";   
    }               
    else  {   
        $pagLink .= "<a href='homepage.php?page=".$i."'>".$i." </a>";     
    }   
  };     
  
  echo $pagLink;   

  if($page<$total_pages){   
      echo "<a href='homepage.php?page=".($page+1)."'>  Next </a>";   
  }   
  

?>