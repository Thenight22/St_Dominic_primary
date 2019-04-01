<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$conn = @mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

if(isset($_GET["classid"]) AND isset($_GET["termid"])){
  $classid=$_GET["classid"];
  $classnumber = mysql_real_escape_string($classid); 
  $term = $_GET["termid"];

$query = "SELECT * FROM tblclasses WHERE id = '$classnumber'";


mysql_select_db('domin');
$retval = mysql_query( $query, $conn );

if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}
while($donnees = mysql_fetch_array($retval, MYSQL_ASSOC))
{
  
    
  
$classnamenow = $donnees['ClassName'];  





?>

<html>
<head>
  <title>Term Records Summary</title>
  <style type="text/css">
    body {
      font-size: 15px;
      color: #343d44;
      font-family: "segoe-ui", "open-sans", tahoma, arial;
      padding: 0;
      margin: 0;
    }
    table {
      margin: auto;
      font-family: "Lucida Sans Unicode", "Lucida Grande", "Segoe Ui";
      font-size: 8px;
    }

    h1 {
      margin: 25px auto 0;
      text-align: center;
      text-transform: uppercase;
      font-size: 12px;
    }

    table td {
      transition: all .5s;
    }
    
    /* Table */
    .data-table {
      border-collapse: collapse;
      font-size: 10px;
      min-width: 537px;
    }

    .data-table th, 
    .data-table td {
      border: 1px solid #e1edff;
      padding: 2px 8px;
      text-align:center;
    }
    .data-table caption {
      margin: 2px;
    }

    table { 
      page-break-inside:auto 
    }
    tr    { 
        page-break-inside:avoid; 
        page-break-after:auto }

    /* Table Header */
    .data-table thead th {
      background-color: #508abb;
      color: #FFFFFF;
      border-color: #6ea1cc !important;
      text-transform: uppercase;
    }

    /* Table Body */
    .data-table tbody td {
      color: #353535;
    }
    .data-table tbody td:first-child,
    .data-table tbody td:nth-child(4),
    .data-table tbody td:last-child {
      text-align: left;
    }

    .data-table tbody tr:nth-child(odd) td {
      background-color: #f4fbff;
    }
    .data-table tbody tr:hover td {
      background-color: #ffffa2;
      border-color: #ffff0f;
    }

    /* Table Footer */
    .data-table tfoot th {
      background-color: #e5f5ff;
      text-align: left;
    }
    .data-table tfoot th:first-child {
      text-align: left;
    }
    .data-table tbody td:empty
    {
      background-color: #ffcccc;
    }
  </style>
</head>
<body>
  <h1>CLASS RESULT SUMMARY - <?php echo $classnamenow." ". $donnees['level']; ?></h1>
  <table class="data-table">
    <caption class="title"></caption>
 
     
        <th>NAMES</th>
        <th>KINYARWANDA</th>
        <th>ENGLISH</th>
        <th>MATHS</th>
        <th>SCIENCE</th>
        <th>S. STUDIES</th>
        <th>FRENCH</th>
        <th>SWAHILI</th>
        <th>RELIGION</th>
        <th>COMPUTER</th>
        <th>ART/MUSIC</th>
        <th>SPORTS</th>
        <th>PERCENTAGE</th>
        <th>POSITION</th>

    



 <?php


if ($donnees['level'] == 'upper') {
$sql = "SELECT *, FIND_IN_SET( perc, (
SELECT GROUP_CONCAT( perc 
ORDER BY perc DESC) 
FROM results_upper WHERE class ='$classnamenow' AND year = '2019' AND term = '$term' ORDER BY perc )
) AS rank
FROM results_upper WHERE class ='$classnamenow' AND year = '2019' AND term = '$term' ORDER BY perc DESC";
}

elseif ($donnees['level'] == 'lower') {
   

 
$sql = "SELECT *, FIND_IN_SET( perc, (
SELECT GROUP_CONCAT( perc 
ORDER BY perc DESC) 
FROM results_lowerR WHERE class ='$classnamenow' AND year = '2019' AND term = '$term' ORDER BY perc )
) AS rank
FROM results_lowerR WHERE class ='$classnamenow' AND year = '2019' AND term = '$term' ORDER BY perc DESC";

}
 
}
mysql_select_db('domin');
$retval = @mysql_query( $sql, $conn );
// $retval2 = mysql_query($sqlposition,$conn);

$numberofstudents = mysql_num_rows( $retval);

if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}
$i = "";


while($row = mysql_fetch_array($retval, MYSQL_ASSOC))    {
  if ($row['level']=='lower') {
    
  
  $i = $row['rank'];
  $totaltest = ($row['kinytest']+$row['engtest']+$row['mattest']+$row['sciencetest']+$row['sstest']+$row['frenchtest']+$row['swahilitest']+$row['religiontest']+$row['comptest']+$row['artmusictest']+$row['sporttest']);

$totalexam = ($row['kinyexam']+$row['engexam']+$row['matexam']+$row['scienceexam']+$row['ssexam']+$row['frenchexam']+$row['swahiliexam']+$row['religionexam']+$row['compexam']+$row['artmusicexam']+$row['sportexam']);
 $percentage = $row['perc'];
}
elseif ($row['level']=='upper') {
  $i = $row['rank'];
  $percentage = $row['perc'];
}
      echo '<tr>
          
          <td>'.$row['names'].'</td>
          <td>'.($row['kinytest']+$row['kinyexam']).'</td>
          <td>'.($row['engtest']+$row['engexam']).'</td>

          <td>'.($row['mattest']+$row['matexam']).'</td>
          <td>'.($row['sciencetest']+$row['scienceexam']).'</td>
          <td>'.($row['sstest']+$row['ssexam']).'</td>

          <td>'.($row['frenchtest']+$row['frenchexam']).'</td>
          <td>'.($row['swahilitest']+$row['swahiliexam']).'</td>
          <td>'.($row['religiontest']+$row['religionexam']).'</td>

          <td>'.($row['comptest']+$row['compexam']).'</td>
          <td>'.($row['artmusictest']+$row['artmusicexam']).'</td>
          <td>'.($row['sporttest']+$row['sportexam']).'</td>

          <td>'.(number_format((float)$percentage, 2, '.', '')).'%</td>
          <td>'.($i).'</td>
        
        </tr>';
    }?>
    </tbody>

  </table>
  <?php

} 



  ?>
</body>
</html>