<?php
$passwords=["hello","Hello123","Abc!2024","test123!"];

function check_password(string $pwd):array{
  $r=[];
  $r['length_ok']=strlen($pwd)>=8;
  $r['has_upper']=preg_match('/[A-Z]/',$pwd);
  $r['has_digit']=preg_match('/\d/',$pwd);
  $r['has_special']=preg_match('/[^A-Za-z0-9]/',$pwd);
  $r['score']=$r['length_ok']+$r['has_upper']+$r['has_digit']+$r['has_special'];
  return $r;
}

foreach($passwords as $p){
  $r=check_password($p);
  $s=$r['score']<=1?"Weak":($r['score']==2?"Medium":"Strong");
  echo "Password: \"$p\" — Score: {$r['score']}/4 — Strength: $s<br>";
}
?>
