<?php
include("includes/config.php");
$recordId=rand(100000,999999);
if(isset($_POST['OtherData'])){
    $otherData = $_POST['OtherData'];
    $row=json_decode($otherData);
  
    $max=count($row);
  
    for ($i=0; $i < $max; $i++) {
          if($row[$i]!=null){
            $class   = $row[$i]->class;
            $subject = $row[$i]->subject;
            $type    = $row[$i]->type;
            $maximum = $row[$i]->maximum;
            $query=$DB_con->prepare("INSERT INTO `".$type."` (class,`subject`,maximum,recordId) VALUES('$class','$subject','$maximum','$recordId')");
            if($query->execute()){
              $error=0;
            }
            else
            {
              $error=1;
            }
          }
    }
    if($error==0){
        $proced = new \stdClass();
        $proced->status   = "success";
        $proced->message = "The Data is saved Successfully";
        $myJSON = json_encode($proced);
        echo $myJSON;
    }
    else
    {
        $proced = new \stdClass();
        $proced->status  = "fail";
        $proced->message = "Data couldn't be saved";
        $myJSON = json_encode($proced);
        echo $myJSON;
    }
}
if(isset($_POST['TableData'])){
      $tableVal = $_POST['TableData'];
      echo $tableVal;
      $table=json_decode($tableVal);
      foreach ($table as $key => $value) {
        $id=$table[$key]->id;
        $marks=$table[$key]->marks;
        $query2=$DB_con->prepare("INSERT INTO `".$type."_detailed` (`recordId`, `student_id`, `marks`) VALUES ('$recordId', '$id', '$marks')");
        if($query2->execute()){
          $proced = new \stdClass();
          $proced->status   = "success";
          $proced->message = "The Data is saved Successfully";
          $myJSON = json_encode($proced);
          echo $myJSON;
        } else {
          $proced = new \stdClass();
          $proced->status  = "fail";
          $proced->message = "Data couldn't be saved";
          $myJSON = json_encode($proced);
          echo $myJSON;
        }
}
}
?>