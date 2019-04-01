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
$studentname=$_POST['fullanme'];
$roolid=$_POST['rollid']; 
$studentemail=$_POST['emailid']; 
$gender=$_POST['gender']; 
$class=$_POST['class']; 
$dob=$_POST['dob']; 
$academicyear=$_POST['academicyear']; 
$status=1;

if ($class == 'P1A' OR $class == 'P1B' OR $class == 'P1C' OR $class == 'P2A' OR $class == 'P2B' OR $class == 'P2C' OR $class == 'P3A' OR $class == 'P3B' OR $class == 'P3C') {

$level = 'lower';    
    
}
else{
$level = 'upper';    
}


$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

$sql = "INSERT INTO students".
       "(names,byear,parent_names,Gender,class,active,parent_phone,academicyear) ".
       "VALUES ( '$studentname','$roolid','$studentemail','$gender','$class','$status','$dob','$academicyear' )";


$sql1 = "INSERT INTO students".
       "(names,class, year, term, level) ".
       "VALUES ( '$studentname', '$class', '$academicyear', '1','$level' )";
$sql2 = "INSERT INTO students".
       "(names,class, year, term, level) ".
       "VALUES ( '$studentname', '$class', '$academicyear', '2','$level' )";
$sql3 = "INSERT INTO students".
       "(names,class, year, term, level) ".
       "VALUES ( '$studentname', '$class', '$academicyear', '3','$level' )";       

mysql_select_db('domin');
$retval = mysql_query( $sql, $conn );
$retval1 = mysql_query( $sql1, $conn );
$retval2 = mysql_query( $sql2, $conn );
$retval3 = mysql_query( $sql3, $conn );
if(! $retval AND ! $retval1 AND ! $retval2 AND ! $retval3 )
{
  die('Could not enter data: ' . mysql_error());
}
echo "Entered data successfully\n";

}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SRMS Admin| Update students info</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" >
        <link rel="stylesheet" href="css/select2/select2.min.css" >
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="required/js/jquery.min.js"></script>
        <script src="required/js/bootstrap.min.js"></script>        
        <script src="required/mindmup-editabletable.js"></script>
        <!-- <script src="required/numeric-input-example.js"></script> -->
        <script type="text/javascript">
</script>
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
                                    <h2 class="title">Add student</h2>
                                
                                </div>

                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                
                                        <li class="active">Update students info</li>
                                    </ul>
                                </div>
                             
                            </div>
                            <!-- /.row -->
                        </div>
                        <div class="container-fluid">
                           
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
<div class="col-md-8">
    <h4 id = 'title'>Add many students details at a time. <sup></sup> ACADEMIC YEAR: <?php 

$sqlyear = "SELECT * FROM settings";
$resultyear = $conn->query($sqlyear);

if (mysqli_num_rows($resultyear) > 0) {

$academicyear = $rowyear['academicyear'];
while($rowyear = $resultyear->fetch_assoc()) {
  echo $rowyear['academicyear'];
}
}
  ?> | <?php echo $class ?></h4><h5><small>To edit student info click on the right field and start editing | Records will be saved automatically Just like in Excel</small></h5></div>
                                 <div class="col-md-4" style="float:right"> 
                                            <table>
                                                    <tr>

                                                        <td> </td>
                                                    </tr>
                                            </table> 
                                            


                                    </div>
    <hr/>
        <div class="alert alert-error hide">
            Invalid marks!
        </div>
          <table id="mainTable" class="table table-striped">
            <thead><tr><th>Names</th><th id="th">Gender</th> <th id="th">Birthyear</th><th id="th">Guardian names</th> <th id="th">G. Phone</th><th id="th">Sector</th> <th id="th">Village</th><th id="th">Academic year</th> </tr></thead>
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

$sqlyear = "SELECT * FROM settings";
$resultyear = $conn->query($sqlyear);

if (mysqli_num_rows($resultyear) > 0) {

while($rowyear = $resultyear->fetch_assoc()) {
$academicyear = $rowyear['academicyear'];
$sql = "SELECT * FROM students WHERE active = '1' AND class = '$class'";
$result = $conn->query($sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

      echo "<tr><input type='hidden' value='".$row["id"]."' id='rowId'><td id = 'names' data-type='names'>".$row["names"]."</td><td data-type='Gender' id = 'even'>".$row["Gender"]."</td>"."<td data-type='byear'>".$row["byear"]."</td><td data-type='parent_names' id = 'even'>".$row["parent_names"]."</td><td data-type='parent_phone'>".$row["parent_phone"]."</td><td data-type='sector'>".$row["sector"]."</td><td data-type='village' id = 'even'>".$row["village"]."</td><td data-type='academicyear'>".$row["academicyear"]."</td>"."<td data-type='classs' hidden>".$row["class"]."</td>"."</tr>";
    }
} else {
    echo "0 results";
}
}
}
}
}
?>

</tbody>
          </table>
                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->
        </div>
        <!-- /.main-wrapper -->
      
<script>
  $('#mainTable').editableTableWidget().find('td:first').focus();
  $('#textAreaEditor').editableTableWidget({editor: $('<textarea>')});
</script>
<div id="fb-root"></div>
      
<script type="text/javascript">
  $('table td').on('change', function(evt, newValue) {
  // do something with the new cell value 
  var $rowId=$(this).parent().find("#rowId").val();
  var $colId=$(this).attr("data-type");
  var $newData=$(this).html();
  console.log($rowId,$colId,$newData);
  $.ajax({
    type:'POST',
    url:'required/changeTableData.php',
    data:{rowId:$rowId,colId:$colId,newData:$newData},
    beforeSend :function(){
      // Loading GIF
    },
    success :function(data){
      console.log(data);
    }
  })
});
</script>
<!-- <script type = "text/javascript">
   $('#add').click(function(){
   var html = '<tr>';
   html += '<td contenteditable id="namesnew" data-type="namesnew"></td>';
   html += '<td contenteditable id="Gender" data-type="Gender"></td>';
   html += '<td contenteditable id="byear" data-type="byear"></td>';
   html += '<td contenteditable id="parent_names" data-type="parent_names"></td>';
   html += '<td contenteditable id="parent_phone" data-type="parent_phone"></td>';
      html += '<td contenteditable id="sector" data-type="sector"></td>';
         html += '<td contenteditable id="village" data-type="village"></td>';
            html += '<td contenteditable id="academicyear" data-type="academicyear"></td>';
   html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
   html += '</tr>';
   $('#mainTable tbody').prepend(html);

  });

</script>
 -->


<script type="text/javascript">
  

    $(document).on('click', '#insert', function(){  
        var names = $('#namesnew').text();  
        var Gender = $('#Gender').text();  
        var byear = $('#byear').text();
        var parent_names = $('#parent_names').text();
        var parent_phone = $('#parent_phone').text();
        var classs = $('#classs').text();
        var sector = $('#sector').text();
        var village = $('#village').text();
        var academicYear = $('#academicyear').text();
        // console.log(names,Gender,byear,parent_names,parent_phone,sector,village,academicYear);
        if(names == '')  
        {  
            alert("Enter names");  
            return false;  
        }  
        if(Gender == '')  
        {  
            alert("Enter Gender");  
            return false;  
        }  
                if(byear == '')  
        {  
            alert("Enter student's Birth year");  
            return false;  
        }  
                if(parent_names == '')  
        {  
            alert("Enter student's Guardian names");  
            return false;  
        }  
                if(parent_phone == '')  
        {  
            alert("Enter student's parent phone");  
            return false;  
        }  
        if(sector == '')  
        {  
            alert("Enter student's sector");  
            return false;  
        }  

        if(village == '')  
        {  
            alert("Enter student's village");  
            return false;  
        }  
        if(academicyear == '')  
        {  
            alert("Enter the academic year");  
            return false;  
        }  
        $.ajax({  
            url:"required/insert.php",  
            method:"POST",  
            data:{
                names:names,
                Gender:Gender,
                byear:byear,
                classs:classs,
                parent_names:parent_names,
                parent_phone:parent_phone,
                sector:sector,
                village:village,
                academicyear:academicyear
            },  
            dataType:"text",  
            success:function(data)  
            {  
                alert(data);  
                fetch_data();  
            }  
        })  
    });  
    



</script>

    </body>
</html>

