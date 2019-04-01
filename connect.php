<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'domin';
try{
$DB_con = new PDO("mysql:host={$host};dbname={$database}",$username,$password);
$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
return $DB_con;
}
catch(PDOException $e){
echo $e->getMessage();
}


?>
