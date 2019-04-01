<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('library.php');
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
            <?php include('includes/topbar.php'); ?>   
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
                                    <h2 class="title">Record Students Marks</h2>
                                </div>
                                
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
            							<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
            							<li><a href="#">Marks</a></li>
            							<li class="active">Record Student Marks</li>
            						</ul>
                                </div>
                               
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->

                        <section class="section">
                            <div class="container-fluid">
                            <form class="recordMarksForm" method="POST"> 
                                <div class="row">
                                    <div class='col-md-12'>
                                    <div class="col-sm-2">
                                <select class="form-control show-tick classSelect" required name="classSelect">
                                        <option value=""> select class </option>
                                <?php
                                    $id=$_SESSION['teacher_id'];
                                    $classes=getTeacherClasses($id);
                                    $eachClass=explode(",",$classes);
                                    $size=count($eachClass);
                                    for ($i=0; $i < $size; $i++) { 
                                        echo "<option value='".$eachClass[$i]."'>".$eachClass[$i]."</option>";
                                    }
                                ?>
                                    </select>
                                </div>

                            <div class="col-sm-2">
                                    <select class="form-control show-tick subjectSelect" required name="subjectSelect">
                                        <option value=""> select subject </option>
                                        <?php
                                            // $subjects=getSubjects();
                                            // $subject=json_decode($subjects);
                                            // foreach ($subject as $key => $value) {
                                            //     echo "<option value='".$subject[$key]->id."'>".$subject[$key]->subject."</option>";
                                            // }
                                            
                                    $id=$_SESSION['teacher_id'];
                                    $subjects=getTeacherSubjects($id);
                                    $eachsubject=explode(",",$subjects);
                                    $size=count($eachsubject);
                                    for ($i=0; $i < $size; $i++) { 
                                        echo "<option value='".$eachsubject[$i]."'>".ucfirst($eachsubject[$i])."</option>";
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
                                <input class="form-control maximum" type="number" name="maximum" step=0.1 value="" placeholder="Max e.g: 15" title = "Enter the maximum score of the evaluation">
                            </div>

                              <div class="col-sm-2">
                                    
                                <button class="btn bg-teal btn-block waves-effect" type="submit" names="marksSubmit">Send</button>
                            </div>
                      
                            </div><br>
                            <table id="mainTable" class="table table-striped tableRecordMarks">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Marks /<b class="maximumMarks">15</b></th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th><strong>Maximum</strong></th>
                                        <th><b class="maximumMarks">15</b></th>
                                        
                                    </tr>
                                </tfoot>
                            </table>

                                    </div>
                                </div>
                                <!-- /.row -->

                              </form> 
                               

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

        <!-- ========== PAGE JS FILES ========== -->
        <script src="js/prism/prism.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>

        <script>
        $(document).ready(function(){
            // $("body").on("keyup",".stMarks",function(){
            //     var $max=$(".maximum").val();
            //     var $marks=$(".stMarks").val();
            //     if($marks>$max){
            //         alert("You can't exceed the maximum value. Maximum Marks:"+$max+" Student Marks:"+$marks);
            //         $(this).val("");
            //     }
            // });
            $(".maximum").on('keyup',function(){
                var $marks=$(this).val();
                $(".maximumMarks").html($marks);
            });
            $(".classSelect").on('change',function(){
                var $class=$(this).find(":selected").val();
                $.ajax({
                type: "POST",
                url: "studDataPage.php",
                data: {
                    selected: $class
                },
                success: function (data) {
                    $(".tableRecordMarks tbody").html('');
                    $(".tableRecordMarks tbody").html(data);
                }
            });
            });

            // Record Marks
            $(".recordMarksForm").on('submit',function(e){
                e.preventDefault();
                var OtherData = JSON.stringify(storeOtherValues());
                var TableData = JSON.stringify(storeTblValues());
                var url="recordMarksPage.php";
                $.ajax({
                type: "POST",
                url: url,
                data: {
                    OtherData: OtherData,
                    TableData: TableData
                },
                success: function (data) {
                    alert("You have successfully entered students marks.");
                },
                error: function(xhr){
                    alert("An error occured: " + xhr.status + " " + xhr.statusText);
                }
            });
            });
  
            function storeOtherValues(){
            var OtherVal = new Array();
                OtherVal[0]={
                    "class":$('.classSelect').find(":selected").val(),
                    "subject":$('.subjectSelect').find(":selected").val(),
                    "type":$('.typeSelect').find(":selected").val(),
                    "maximum":$(".recordMarksForm").find('.maximum').val()
                }
                return OtherVal;
            }

            function storeTblValues() {
                var TableDataVal = new Array();
                $('.tableRecordMarks tbody tr').each(function(row, tr) {
                    if ($(tr).find('td:eq(0) .stId').val() != "" || $(tr).find('td:eq(0) .stNames').val() != "" || $(tr).find('td:eq(1) .stMarks').val()) {
                        TableDataVal[row] = {
                            "id": $(tr).find('td:eq(0) .stId').val(),
                            "names": $(tr).find('td:eq(0) .stNames').val(),
                            "marks": $(tr).find('td:eq(1) .stMarks').val()
                        }
                    }
                });
                return TableDataVal;
                }
    });
</script>

        <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
    </body>
</html>
<?php  } ?>
