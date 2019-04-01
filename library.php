<?php
function getClasses(){
// DB credentials.
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','domin');
// Establish database connection.
try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
$DB_con = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}
//Connection ends
    $query=$DB_con->prepare("SELECT DISTINCT `class` FROM `students` ORDER BY `class` ASC");
    $query->execute();
    $class_array=array();
    if($query->rowCount()>0){
        while($fetch=$query->fetch(PDO::FETCH_ASSOC)){
            $row_array=array();
            $row_array['class']=$fetch['class'];
            array_push($class_array,$row_array);
        }
        return json_encode($class_array);
    } else {
        $class_array['class']="No classes available";
        return json_encode($class_array);
    }
}
function getClassStudents($class){
    include("includes/config.php");
    error_reporting(0);

    $query=$DB_con->prepare("SELECT * FROM `students` WHERE `class`=:class");
    $query->execute(array(
        ":class"=>$class
    ));
    $students_array=array();
    if($query->rowCount()>0){
        while($fetch=$query->fetch(PDO::FETCH_ASSOC)){
            $row_array=array();
            $row_array['id']=$fetch['id'];
            $row_array['names']=$fetch['names'];
            $row_array['parent_names']=$fetch['parent_names'];
            $row_array['parent_phone']=$fetch['parent_phone'];
            $row_array['sector']=$fetch['sector'];
            $row_array['village']=$fetch['village'];
            array_push($students_array,$row_array);
        }
        return json_encode($students_array);
    } else {
        // $students_array['names']="No students there";
        // return json_encode($students_array);
    }
}
function getSubjects(){
    include("includes/config.php");
    $query=$DB_con->prepare("SELECT * FROM `subjects`");
    $query->execute();
    $subject_array=array();
    if($query->rowCount()>0){
        while($fetch=$query->fetch(PDO::FETCH_ASSOC)){
            $row_array=array();
            $row_array['id']=$fetch['id'];
            $row_array['subject']=$fetch['name'];
            array_push($subject_array,$row_array);
        }
        return json_encode($subject_array);
    } else {
        $subject_array['subject']="No subjects available";
        return json_encode($subject_array);
    }
}
function getTeacherClasses($teacher_id){
    include("includes/config.php");
    $query=$DB_con->prepare("SELECT * FROM teachers WHERE id='$teacher_id' LIMIT 1");
    $query->execute();
    if($query->rowCount()>0){
        while($fetch=$query->fetch(PDO::FETCH_ASSOC)){
            $classes=$fetch['classes'];
            return $classes;
        }
    }
}
function getTeacherSubjects($teacher_id){
    include("includes/config.php");
    $query=$DB_con->prepare("SELECT * FROM teachers WHERE id='$teacher_id' LIMIT 1");
    $query->execute();
    if($query->rowCount()>0){
        while($fetch=$query->fetch(PDO::FETCH_ASSOC)){
            $subjects=$fetch['subjects'];
            return $subjects;
        }
    }
}