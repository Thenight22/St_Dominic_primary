<?php
session_start();
// error_reporting(0);
include('includes/config.php');
include('library.php');
// if(strlen($_SESSION['admin'])=="")
//     {   
//     header("Location: index.php"); 
//     }
//     else{

if(!isset($_SESSION['teacher']) && !isset( $_SESSION['admin']))
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
        <title>St Dominic school | Teacher record marks</title>
        <link rel="stylesheet" href="css/bootstrap.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" > <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <link href="js/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
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
          <!-----End Top bar>
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">

<!-- ========== LEFT SIDEBAR ========== -->
<?php 
    if(isset($_SESSION['admin'])){
        include('includes/leftbar.php');
    } else {
        include('includes/d-leftbar.php');
    }
?>                   
 <!-- /.left-sidebar -->

                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">View Students' Recorded Marks</h2>
                                </div>
                                
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
            							<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
            							<li><a href="#">Marks</a></li>
            							<li class="active">View Marks</li>
            						</ul>
                                </div>
                               
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->

                        <section class="section">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class='col-md-12'>
                                    <div class="col-sm-2">
                                <select class="form-control show-tick classSelect" required name="classSelect">
                                        <option value=""> select class </option>
                                <?php
                                    $classes=getClasses();
                                    $class=json_decode($classes);
                                    foreach ($class as $key => $value) {
                                        echo "<option value='".$class[$key]->class."'>".$class[$key]->class."</option>";
                                    }
                                ?>
                                    </select>
                                </div>

                            <div class="col-sm-2">
                                    <select class="form-control show-tick subjectSelect" required name="subjectSelect">
                                        <option value=""> select subject </option>
                                        <?php
                                            $subjects=getSubjects();
                                            $subject=json_decode($subjects);
                                            foreach ($subject as $key => $value) {
                                                echo "<option value='".$subject[$key]->id."'>".$subject[$key]->subject."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-sm-2">
                                    <select class="form-control show-tick typeSelect" required name="typeSelect">
                                        <option value=""> evaluation type </option>
                                        <option value="exams">Exam </option>
                                        <option value="tests">Quiz </option>
                                        <option value="assignments">Assignment </option>
                                        <option value="midterm">Mid Term Exams </option>
                                    </select>
                                </div>

                                <div class="col-sm-2">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="date" class="datepicker form-control" placeholder="Please choose a date...">
                                    </div>
                                </div>
                        </div>

                          <div class="col-sm-2">
                                
                            <button class="btn bg-teal btn-block waves-effect sendBtn">View</button>
                        </div>

                            </div><br>
                            <table id="mainTable" class="getRecordedData table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Marks/15</th>
                                            <th>Ranking</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th><!-- Name --></th>
                                            <th><!-- Average 10.6/15 --></th>
                                            <th><!-- Ranking --></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
 
                                    </tbody>
                                </table>

                                    </div>
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
        <script src="js/jquery-ui/jquery-ui.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>
            <!-- Moment Plugin Js -->
        <script src="js/momentjs/moment.js"></script>
        <!-- Date time picker bootstrap material plugin -->
        <script src="js/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

        <!-- ========== PAGE JS FILES ========== -->
        <script src="js/prism/prism.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>


        <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->

        <script>
            $(".sendBtn").on('click',function(){
                var $class=$(".classSelect").find(":selected").val();
                var $subject=$(".subjectSelect").find(":selected").val();
                var $type=$(".typeSelect").find(":selected").val();
                var $date=$(".datepicker").val();
                $.ajax({
                type: "POST",
                url: "recordedMarksGet.php",
                data: {
                    class: $class,
                    subject: $subject,
                    type: $type,
                    date: $date
                },
                success: function (data) {
                    $(".getRecordedData tbody").html('');
                    $(".getRecordedData tbody").html(data);
                }
            });
            });
            $("#date").bootstrapMaterialDatePicker({weekStart:0,time:false});
    </script>

    </body>
</html>
<?php  } ?>
