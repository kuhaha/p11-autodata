<?php
include('page_header.php');
include('db_inc.php');
$sname = trim($_POST['sname']);
$type = $_POST['type'];
$sql = "insert into tb_subject(sname,type) values ('$sname ',$type)";
$rs = mysql_query($sql, $conn);
if (!$rs) die('エラー: ' . mysql_error());
$sid = mysql_insert_id();
if (is_uploaded_file($_FILES['myfile']['tmp_name'])) {
	$file = $_FILES['myfile']['tmp_name'];
	$trimmed = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	$sql = "insert into tb_element(sid,ename) values ";
	$i = 0;
	foreach ($trimmed as $elem){
		if (!empty($elem)){
			if ( $i > 0) $sql .= ',';
			$sql .= "($sid,'{$elem}')";
			$i++;
		}
	}
	$rs = mysql_query($sql, $conn);
	if (!$rs) die('エラー: ' . mysql_error());
	echo $sname . "の題材の登録が成功しました";
}else{
	echo "error";
}
include('page_footer.php');
?>