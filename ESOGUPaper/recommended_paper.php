  <?php
 
  function is_title_available(string $paper_title){
    include 'mongodb.php';
    $filter = [ 'title' => $paper_title ]; 
    $query = new MongoDB\Driver\Query($filter); 
    $rows = $mongo_conn->executeQuery("Paper.Papers", $query);

    $paper = current($rows->toArray());

    $check;

    if(empty($paper)){

      $check = false;

    }else{

      $check = true;
    }

    return $check;
  }

  function is_recommendation_engine_being_worked(string $paper_title){

    //$command = escapeshellcmd('conda config --set auto_activate_base True && activate recommendation && python recommendation_engine.py');
    $output = exec('conda config --set auto_activate_base True && activate recommendation && python recommendation_engine.py "'.$paper_title.'"');
    //$output = exec('python test.py');

    if(empty($output)){

      return null;

    }else{

      return $output ;
    }


  }

  function recommended_paper($paper_title) {        

    if(is_title_available($paper_title) && !is_null($output = is_recommendation_engine_being_worked($paper_title))){
        echo"<form action='paper.php' method='POST'>";
          echo"<div style='color:white'>";

              $out = json_decode($output,true);

              for ($x = 0; $x < 10; $x++) {

                echo"<form action='paper.php' method='POST'>";
                echo"<div style='color:white'>";
                echo "<input type='submit' name='submit' class='btn btn-outline-info' style='width:100%; text-align: left;display:block; padding-bottom:5px; margin-bottom:5px' value='".$out['title'][$x]."'/>";
                echo "<input type='hidden' id='paper_id' name='paper_id' value='".$out['paper_id'][$x]."'>";

                echo"</div>";
                echo"</form>";    
              }
        
          echo"</div>";
        echo"</form>";

     }
  }
       
  ?>
