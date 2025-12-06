<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dynamic Student Information Processor</title>
<style>
body{font-family:Arial,sans-serif;background:#f4f7fa;margin:0;padding:20px}
table{width:100%;border-collapse:collapse;background:#fff;box-shadow:0 2px 10px #0001}
th,td{border:1px solid #ddd;padding:10px;text-align:center}
th{background:#007bff;color:#fff}
tr:nth-child(even){background:#f2f2f2}
h1{text-align:center;margin-bottom:20px;color:#333}
</style>
</head>
<body>
<h1>Dynamic Student Information Processor</h1>
<table>
<tr><th>Name</th><th>Age</th><th>Marks</th><th>Average</th><th>Status</th><th>Message</th></tr>
<?php
function processStudent($s){
  $total=array_sum($s['marks']);
  $avg=$total/count($s['marks']);
  if($avg>=80)$s['status']="Excellent";
  elseif($avg>=60)$s['status']="Good";
  elseif($avg>=40)$s['status']="Pass";
  else $s['status']="Fail";
  switch($s['status']){
    case"Excellent":$msg="Awarded Scholarship";break;
    case"Good":$msg="Can Apply for Internship";break;
    case"Pass":$msg="Needs Improvement";break;
    default:$msg="Repeat Semester";
  }
  echo"<tr><td>{$s['name']}</td><td>{$s['age']}</td><td>".implode(', ',$s['marks'])."</td><td>".number_format($avg,1)."</td><td>{$s['status']}</td><td>$msg</td></tr>";
}

$s1=['name'=>'Ali','age'=>20,'marks'=>explode(',','78,65,90,55,88')];
$s2=['name'=>'Ayesha','age'=>'21 years','marks'=>explode(',','90,85,92,80,88')];
$s2['age']=(int)$s2['age'];
$s3=['name'=>'Bilal','age'=>21,'marks'=>explode(',','30,45,28,40,35')];
$students=[$s1,$s2,$s3];

foreach($students as $s)processStudent($s);
?>
</table>
</body>
</html>
