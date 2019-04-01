<?php
include_once("library.php");

if(isset($_POST['selected'])){
    $selected=$_POST['selected'];
    if($selected!=""){
        if(getClassStudents($selected)!=""){
            $classStudentsJSON=getClassStudents($selected);
            $classStudents=json_decode($classStudentsJSON);
            foreach ($classStudents as $key => $value) {
                echo "<tr><td><input type='hidden' class='stId' name='stId' value='".$classStudents[$key]->id."'><input class='stNames' style='background:transparent;border:0;' type='text' value='".$classStudents[$key]->names."' disabled></td><td><input class='stMarks' type='number' step=0.1 value=''style='padding:5px;width:50px;text-align:center;border-radius:3px;border:1px solid teal;'></td></tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No students in this class</tr>";
        }

    } else {
        echo "Empty";
    }

} else {
    echo "Nothing to display";
}