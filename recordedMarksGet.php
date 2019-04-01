<?php
     include("includes/config.php");
     if(isset($_POST['class']) && isset($_POST['subject']) && isset($_POST['type'])){
         $class=$_POST['class'];
         $subject=$_POST['subject'];
         $type=$_POST['type'];
         $date=$_POST['date'];
         $strDate=strtotime($date);
         $newDate=date("Y-m-d",$strDate);
         $query=$DB_con->prepare("SELECT * FROM `".$type."` WHERE `class`='$class' AND `subject`='$subject' AND date(time)='$newDate'");
         $query->execute();
         if($query->rowCount()>0){
            while($fetch=$query->fetch(PDO::FETCH_ASSOC)){
                $recordId=$fetch['recordId'];
                $queryGet=$DB_con->prepare("SELECT (SELECT `names` FROM `students` WHERE `id`=`student_id`) AS `names`,`marks` FROM `".$type."_detailed` WHERE `recordId`='$recordId' ORDER BY `marks` DESC");
                $queryGet->execute();
                $i=1;
                while($fetchGet=$queryGet->fetch(PDO::FETCH_ASSOC)){
                    $names=$fetchGet['names'];
                    $marks=$fetchGet['marks'];
                    echo "<tr><td>".$names."</td><td>".$marks."</td><td>".$i."</td></tr>";
                    $i=$i+1;
                }
            }
         }
         else {
             echo "<tr><td colspan='3'>No data found on this date: ".$newDate."</tr>";
         }
     }
?>