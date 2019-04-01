<?php
session_start();
include('includes/config.php');
// if($_SESSION['alogin']!=''){
// $_SESSION['alogin']='';
// }
// if(isset($_POST['login']))
// {
// $uname=$_POST['username'];
// $password=md5($_POST['password']);
// $sql ="SELECT UserName,Password FROM admin WHERE UserName=:uname and Password=:password";
// $query= $dbh -> prepare($sql);
// $query-> bindParam(':uname', $uname, PDO::PARAM_STR);
// $query-> bindParam(':password', $password, PDO::PARAM_STR);
// $query-> execute();
// $results=$query->fetchAll(PDO::FETCH_OBJ);
// if($query->rowCount() > 0)
// {
// $_SESSION['admin']=$_POST['username'];
// echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
// } else{
    
//     echo "<script>alert('Admin Access Denied. Wrong Username/Password');</script>";

// }

// }
if(isset($_POST['login']))
{
$tuname=$_POST['username'];
$tpassword=$_POST['password'];
$sql ="SELECT `id`,`username`,`password` FROM teachers WHERE `username`=:uname and `password`=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':uname', $tuname, PDO::PARAM_STR);
$query-> bindParam(':password', $tpassword, PDO::PARAM_STR);
$query-> execute();

if($query->rowCount() > 0)
{
    $teacher_id="";
    while($results=$query->fetch(PDO::FETCH_ASSOC)){
    $teacher_id.=$results['id'];
    }
    $_SESSION['teacher_id']=$teacher_id;
    $_SESSION['admin']=$_POST['username'];

    echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
} else{
    
    echo "<script>alert('Teachers Access Denied. Wrong Username/Password');</script>";

}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Teachers Login - St Dominic School system</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="shortcut icon" href="images/image002.png" />
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<center>
				<img src="images/image002.png" style="height:80px; width:80px;">
			</center>
				<form class="login100-form validate-form" method="post">
					<span class="login100-form-title p-b-26">
						S<sup>t</sup> Dominic school
					</span>
					<span class="login100-form-title p-b-48">
<!-- 						<i class="zmdi zmdi-font"></i>
 -->					
<!-- <img src="images/image002.png" style="height:80px; width:80px;">
 --></span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
						<input class="input100" type="text" name="username">
						<span class="focus-input100" data-placeholder="username"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type = "submit" class="login100-form-btn" name="login">
								Login
							</button>
						</div>
					</div>

					<div class="text-center p-t-115">
						<span class="txt1">
							
						</span>

						<a class="txt2" href="#" title="St Dominic School system - iWACU Labs">
							S<sup>t</sup> Dominic School Results and Communication system. 
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main2.js"></script>

</body>
</html>