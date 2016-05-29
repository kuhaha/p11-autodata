<?php session_start();
$userid = $_POST['uid'];
$passwd = $_POST['upass'];
$sql = "SELECT * FROM tb_user WHERE uid='{$userid}' AND upass='{$passwd}'";
include('db_inc.php');
$rs = mysql_query($sql, $conn);
if ($rs) {
  $row = mysql_fetch_array($rs);  //問合せ結果を配列として一行受け取る
  if ($row){
  	$_SESSION['uid']=$row['uid'];
    $_SESSION['uname'] = $row['uname'];
  	$_SESSION['utype']=$row['utype'];
    header('Location:index.php');
  }else{
    unset($_SESSION['uid']);
    header('Location:login.php');
  }
} 
?>