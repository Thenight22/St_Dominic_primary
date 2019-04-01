<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['admin'])=="")
    {   
    header("Location: index.php"); 
    }
    else{


if(isset($_POST['submit']))
{
$year=$_POST['AcademicYear'];
include('includes/config.php');
$sql = "UPDATE settings SET academicyear='$year'";


if ($conn->query($sql) === TRUE) {
    $msg ="Record updated successfully";
}

}

?>




<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SRMS Admin| Student Admission< </title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" >
        <link rel="stylesheet" href="css/select2/select2.min.css" >
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
    </head>
    <body class="top-navbar-fixed">
        <div class="main-wrapper">

            <!-- ========== TOP NAVBAR ========== -->
  <?php include('includes/topbar.php');?> 
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">

                    <!-- ========== LEFT SIDEBAR ========== -->
                   <?php include('includes/leftbar.php');?>  
                    <!-- /.left-sidebar -->

                    <div class="main-page">

                     <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title" style="float:left;">

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "domin";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$value = $_SESSION['admin'];  
$sql = "SELECT * FROM teachers WHERE username = '$value'";
$result = $conn->query($sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $class = $row['classes'];
        // echo $row['classes'];
    }
}
?>
</h2> <?php $sql = "SELECT academicyear from settings";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0){
    foreach($results as $result)
{
echo '<h2> Academic year is: '.$result->academicyear.'</h2>';
echo '<h2> Your class is: '.$class.'</h2>';
}
}
?>
                                
                                </div>
                                <div class="col-md-2" style="float:right">  
                        
                                     </div>
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                
                                        <li class="active">Update Academic Year</li>
                                    </ul>
                                </div>
                             
                            </div>
                            <!-- /.row -->
                        </div>
                        <div class="container-fluid">
                           <br>
                        <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>&nbsp;&nbsp;&nbsp;&nbsp;Use the dropdown below to update the academic year! [CRITICAL] </h5>

                                                </div>
                                            </div>
                                            <div class="panel-body">

<form method="POST" action=""> 


                                                    <div class="form-group">
                                                        <div class="col-sm-8">
<table>
    <tr>
        <td>

<select name="AcademicYear" class="form-control" id="default" required="required">
<option value="">Select academic year</option>

<option value="2019">2019</option>
<option value="2019">2019</option>
<option value="2020">2020</option>
<option value="2021">2021</option>

        </td>
        <td>    
<button type="submit" name="submit" class="btn btn-primary">Update</button>
        </td>
    </tr>
</table>
 </select>

                                                        </div>

                                                    </div>

                                                    

                                                    
                                                    <div class="form-group">
                                                        <div class="col-sm-2">
                                                            <!-- <button type="submit" name="submit" class="btn btn-primary">Update</button> -->
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-md-12 -->
                                </div>
                    </div>
                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->
        </div>
        <!-- /.main-wrapper -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>
        <script src="js/prism/prism.js"></script>
        <script src="js/select2/select2.min.js"></script>
        <script src="js/main.js"></script>
        <script>
            $(function($) {
                $(".js-states").select2();
                $(".js-states-limit").select2({
                    maximumSelectionLength: 2
                });
                $(".js-states-hide").select2({
                    minimumResultsForSearch: Infinity
                });
            });
        </script>
    </body>
</html>
<?PHP } ?>
