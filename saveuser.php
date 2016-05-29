<?php
include('page_header.php');
$uname = $_POST['uname'];
$uid=  $_POST['uid'];
$upass1 =  $_POST['password1'];
$upass2 =  $_POST['password2'];
if($upass1==$upass2){
	$sql="insert into tb_user(uid,uname,upass,utype) values
 ('$uid','$uname','$upass1',1)";
	include('db_inc.php');
	$rs = mysql_query($sql, $conn);
	if (!$rs) die('エラー: ' . mysql_error());
	echo "<h2>アカウント新規登録完了</h2>";
}else{
	echo "パスワードが一致しません。";
	echo'<p><a href="newuser.php">登録画面に戻る</a></p>';
}
include('page_footer.php');
?>