<?php 
include('page_header.php');
include('db_inc.php');

if(isset($_SESSION['uid'])){
	$uid=$_SESSION['uid'];
	$uname=$_SESSION['uname'];
}

$hist = $_POST['hist'];
$hdate = date('Y-m-d');
$snum = $_POST['snum'];
$enum = $_POST['enum'];
$dai = $_POST['dai'];
$min = $_POST['min'];
$max = $_POST['max'];
$len = $_POST['len'];
$pref = $_POST['pref'];
$suf = $_POST['suf'];

$sql = 'insert into tb_history(hname,uid,hdate,snum,enum)' .
 "values( '{$hist}', '{$uid}','{$hdate}',{$snum},{$enum})";
//echo $sql;
$rs = mysql_query($sql, $conn);

$hid = mysql_insert_id();
//echo $hid;
$sql = 'insert into tb_term_history(hid,sid,min,max,len,pref,suf) values' ;
$i = 0;
foreach ($dai as $d){
	$sql .= '(' .$hid .','.$d . ','.n($min[$i]).','.n($max[$i]).','.n($len[$i]).','.s($pref[$i]).','.s($suf[$i]).'),';
	$i++;
}
$sql = rtrim($sql,',');
$rs = mysql_query($sql, $conn);
echo '<h2>履歴は保存しました</h2>';
include('page_footer.php');

function n($str){
  if (empty($str)) return 'null';
  return (int)$str;
}
function s($str){
  if (empty($str)) return 'null';
  return "'" . $str . "'";
}
?>