
<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['admin'])=="")
    {   
    header("Location: index.php"); 
    }
    else{
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Class Reports</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" > <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
        <link rel="stylesheet" type="text/css" href="js/DataTables/datatables.min.css"/>
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
          <style>
        .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
        </style>
    </head>
    <body class="top-navbar-fixed">
        <div class="main-wrapper">

            <!-- ========== TOP NAVBAR ========== -->
   <?php include('includes/topbar.php');?> 
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">
<?php include('includes/leftbar.php');?>  

                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">Class reports</h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
            							<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                        <li> Classes</li>
            							<li class="active">Class reports</li>
            						</ul>
                                </div>
                             
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->

                        <section class="section">
                            <div class="container-fluid">

                             

                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>View Classes Info</h5>
                                                </div>
                                            </div>
<?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
 <strong>Well done!</strong><?php echo htmlentities($msg); ?>
 </div><?php } 
else if($error){?>
    <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } ?>
                                            <div class="panel-body p-20">




                                                <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Term</th>
                                                            <th>Reports</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
                                                          <th>Term</th>
                                                            <th>Reports</th>
                                                        </tr>
                                                    </tfoot>
                                                    <tbody>


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

?>


<?php 
$sql = "SELECT * from tblclasses WHERE ClassName = '$class'";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>


<tr>
  <td>First</td>
<td>
 
<?php if ($result->level == "lower")
{
 echo '<a href="termreportlower.php?classid='.$result->id.'&termid=1"> <button class="btn btn-warning" title="Print first term reports">1<sup>st</sup> Term Reports</button> </a>';
   
}

elseif ($result->level == "upper") {
 echo '<a href="termreportupper.php?classid='.$result->id.'&termid=1"> <button class="btn btn-warning" title="Print first term reports">1<sup>st</sup> Term Reports</button> </a>';
}

elseif ($result->level == "nursery" AND $result->ClassName == "N1A" OR $result->ClassName == "N1B" OR $result->ClassName == "N1C" OR $result->ClassName == "N1D") {

 echo '<a href="nurseryreport.php?classid='.$result->id.'&termid=1"> <button class="btn btn-warning" title="Print first term reports">1<sup>st</sup> Term Reports</button> </a>';
      
}
elseif($result->level == "nursery" AND $result->ClassName == "N2A" OR $result->ClassName == "N2B") {
 echo '<a href="middlereport.php?classid='.$result->id.'&termid=1"> <button class="btn btn-warning" title="Print first term reports">1<sup>st</sup> Term Reports</button> </a>';
    
}
elseif($result->level == "nursery" AND $result->ClassName == "N3A" OR $result->ClassName == "N3B") {
 echo '<a href="topreport.php?classid='.$result->id.'&termid=1"> <button class="btn btn-warning" title="Print first term reports">1<sup>st</sup> Term Reports</button> </a>';
    
}
 ?>




<?php 

if ($result->level == "lower")
{
echo '| <a href="middletermreportlower.php?classid='.$result->id.'&termid=1"> <button class="btn btn-default" title="Print first Midterm reports">Midterm Reports</button> </a>';
   
}
// else{
//  echo '<a href="termreportupper.php?classid='.$result->id.'"> <span class = "linktoreports"> Make reports</span></a>';
   
// }
elseif ($result->level == "upper") {
echo '| <a href="MiddleTermUpperreport.php?classid='.$result->id.'&termid=1"> <button class="btn btn-default" title="Print first Midterm reports">Midterm Reports</button> </a>';
}


?> 



<?php 

if ($result->level == "lower")
{
echo '| <a href="proclammation.php?classid='.$result->id.'&termid=1"> <button class="btn btn-success" title="Print term summary report">Resuts summary</button> </a>';
   
}

elseif ($result->level == "upper") {
echo '| <a href="proclammation.php?classid='.$result->id.'&termid=1"> <button class="btn btn-success" title="Print term summary report">Resuts summary</button> </a>';
}


?> 

   

</td>
</tr>




<tr>
  <td>Second</td>
<td>
 
<?php if ($result->level == "lower")
{
 echo '<a href="termreportlower.php?classid='.$result->id.'&termid=2"> <button class="btn btn-warning" title="Print second term reports">2<sup>nd</sup> Term Reports</button> </a>';
   
}

elseif ($result->level == "upper") {
 echo '<a href="termreportupper.php?classid='.$result->id.'&termid=2"> <button class="btn btn-warning" title="Print second term reports">2<sup>nd</sup> Term Reports</button> </a>';
}

elseif ($result->level == "nursery" AND $result->ClassName == "N1A" OR $result->ClassName == "N1B" OR $result->ClassName == "N1C" OR $result->ClassName == "N1D") {

 echo '<a href="nurseryreport.php?classid='.$result->id.'&termid=2"> <button class="btn btn-warning" title="Print second term reports">2<sup>nd</sup> Term Reports</button> </a>';
      
}
elseif($result->level == "nursery" AND $result->ClassName == "N2A" OR $result->ClassName == "N2B") {
 echo '<a href="middlereport.php?classid='.$result->id.'&termid=2"> <button class="btn btn-warning" title="Print second term reports">2<sup>nd</sup> Term Reports</button> </a>';
    
}
elseif($result->level == "nursery" AND $result->ClassName == "N3A" OR $result->ClassName == "N3B") {
 echo '<a href="topreport.php?classid='.$result->id.'&termid=2"> <button class="btn btn-warning" title="Print second term reports">2<sup>nd</sup> Term Reports</button> </a>';
    
}
 ?>




<?php 

if ($result->level == "lower")
{
echo '| <a href="middletermreportlower.php?classid='.$result->id.'&termid=2"> <button class="btn btn-default" title="Print second Midterm reports">Midterm Reports</button> </a>';
   
}
// else{
//  echo '<a href="termreportupper.php?classid='.$result->id.'"> <span class = "linktoreports"> Make reports</span></a>';
   
// }
elseif ($result->level == "upper") {
echo '| <a href="MiddleTermUpperreport.php?classid='.$result->id.'&termid=2"> <button class="btn btn-default" title="Print second Midterm reports">Midterm Reports</button> </a>';
}


?> 



<?php 

if ($result->level == "lower")
{
echo '| <a href="proclammation.php?classid='.$result->id.'&termid=2"> <button class="btn btn-success" title="Print term summary report">Resuts summary</button> </a>';
   
}

elseif ($result->level == "upper") {
echo '| <a href="proclammation.php?classid='.$result->id.'&termid=2"> <button class="btn btn-success" title="Print term summary report">Resuts summary</button> </a>';
}


?> 

   

</td>
</tr>




<tr>
  <td>Third</td>
<td>
 
<?php if ($result->level == "lower")
{
 echo '<a href="termreportlower.php?classid='.$result->id.'&termid=3"> <button class="btn btn-warning" title="Print Third term reports">3<sup>rd</sup> Term Reports</button> </a>';
   
}

elseif ($result->level == "upper") {
 echo '<a href="termreportupper.php?classid='.$result->id.'&termid=3"> <button class="btn btn-warning" title="Print Third term reports">3<sup>rd</sup> Term Reports</button> </a>';
}

elseif ($result->level == "nursery" AND $result->ClassName == "N1A" OR $result->ClassName == "N1B" OR $result->ClassName == "N1C" OR $result->ClassName == "N1D") {

 echo '<a href="nurseryreport.php?classid='.$result->id.'&termid=3"> <button class="btn btn-warning" title="Print Third term reports">3<sup>rd</sup> Term Reports</button> </a>';
      
}
elseif($result->level == "nursery" AND $result->ClassName == "N2A" OR $result->ClassName == "N2B") {
 echo '<a href="middlereport.php?classid='.$result->id.'&termid=3"> <button class="btn btn-warning" title="Print Third term reports">3<sup>rd</sup> Term Reports</button> </a>';
    
}
elseif($result->level == "nursery" AND $result->ClassName == "N3A" OR $result->ClassName == "N3B") {
 echo '<a href="topreport.php?classid='.$result->id.'&termid=3"> <button class="btn btn-warning" title="Print Third term reports">3<sup>rd</sup> Term Reports</button> </a>';
    
}
 ?>




<?php 

if ($result->level == "lower")
{
echo '| <a href="middletermreportlower.php?classid='.$result->id.'&termid=3"> <button class="btn btn-default" title="Print Third Midterm report3">Midterm Reports</button> </a>';
   
}
// else{
//  echo '<a href="termreportupper.php?classid='.$result->id.'"> <span class = "linktoreports"> Make reports</span></a>';
   
// }
elseif ($result->level == "upper") {
echo '| <a href="MiddleTermUpperreport.php?classid='.$result->id.'&termid=3"> <button class="btn btn-default" title="Print Third Midterm report3">Midterm Reports</button> </a>';
}


?> 



<?php 

if ($result->level == "lower")
{
echo '| <a href="proclammation.php?classid='.$result->id.'&termid=3"> <button class="btn btn-success" title="Print term summary report">Resuts summary</button> </a>';
   
}

elseif ($result->level == "upper") {
echo '| <a href="proclammation.php?classid='.$result->id.'&termid=3"> <button class="btn btn-success" title="Print term summary report">Resuts summary</button> </a>';
}


?> 

   

</td>
</tr>

<tr>
  <td>Total</td>
<td>
 
 <?php 

if ($result->level == "lower")
{
echo '<a href="annualreportlower.php?classid='.$result->id.'"> <button class="btn btn-primary" title="Print Annual reports" style ="mouse-events:none;">Annual Reports</button> </a>';
   
}

elseif ($result->level == "upper") {
echo '<a href="annualreportupper.php?classid='.$result->id.'"> <button class="btn btn-primary" title="Print Annual reports" style ="mouse-events:none;">Annual Reports</button> </a>';
}


?> 

   

</td>
</tr>
<?php $cnt=$cnt+1;}} }?>
                                                       
                                                    
                                                    </tbody>
                                                </table>

                                         
                                                <!-- /.col-md-12 -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-md-6 -->

                                                               
                                                </div>
                                                <!-- /.col-md-12 -->
                                            </div>
                                        </div>
                                        <!-- /.panel -->
                                    </div>
                                    <!-- /.col-md-6 -->

                                </div>
                                <!-- /.row -->

                            </div>
                            <!-- /.container-fluid -->
                        </section>
                        <!-- /.section -->

                    </div>
                    <!-- /.main-page -->

                    

                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->

        </div>
        <!-- /.main-wrapper -->

        <!-- ========== COMMON JS FILES ========== -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>

        <!-- ========== PAGE JS FILES ========== -->
        <script src="js/prism/prism.js"></script>
        <script src="js/DataTables/datatables.min.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>
        <script>
            $(function($) {
                $('#example').DataTable();

                $('#example2').DataTable( {
                    "scrollY":        "300px",
                    "scrollCollapse": true,
                    "paging":         false
                } );

                $('#example3').DataTable();
            });
        </script>
    </body>
</html>
<?php } ?>

