<?php include('page_header.php');
include('db_inc.php');
$hdai  = array();
$hmin  = $hmax = $hlen = array();
$hpref = $hsuf = array();

if (isset($_POST['snum'])){ // 指定の項目数、発生数で詳細な条件を入力する画面を作る
	$snum  = $_POST['snum'];
	$enum    = $_POST['enum'];
}else if (isset($_POST['hid'])){ // 履歴から条件を調べる
	$hid = $_POST['hid'];
	$sql = "select * from tb_history where hid={$hid}";
	$rs = mysql_query($sql, $conn);
	$row = mysql_fetch_array($rs);
	if ($row){
		$snum = $row['snum'];
		$enum = $row['enum'];
	}
	$sql = "select * from tb_term_history where hid={$hid}";
	$rs = mysql_query($sql, $conn);
	while ( $row = mysql_fetch_array($rs) ){
		$hdai[] = $row['sid'];
		$hmin[] = $row['min'];
		$hmax[] = $row['max'];
		$hlen[] = $row['len'];
		$hpref[] = $row['pref'];
		$hsuf[] = $row['suf'];
	}
}
//print_r($hdai);print_r($hmin);print_r($hmax);print_r($hspace);　//デバッグ

$options = array();// 選択可能な題材を調べる
$sql = 'SELECT * FROM tb_subject ORDER BY type';
$rs = mysql_query($sql, $conn);
while ( $row = mysql_fetch_array($rs) ) {
	$sid = $row['sid'];
	$sname = $row['sname'];
	$options[$sid] = $sname;
}

if (isset($snum) and isset($enum)){
	echo '<form action="result.php" method="post">';
	echo '<input type="hidden" name="snum" value="' .$snum. '">';
	echo '<input type="hidden" name="enum" value="' .$enum. '">';
	//echo $hist,$dnum,$enum;
	echo '<table class="table table-bordered table-hover">';
	echo "<tr><th>項目名</th><th>最小値</th><th>最大値</th><th>長さ</th><th>前書き</th><th>後書き</th></tr>";
	for($i=0;$i<$snum;$i++){
		echo '<tr>';
		$selected =(isset($hdai[$i])) ? trim($hdai[$i]) : -1;
		echo'<td>' . subject_select($options, "dai[{$i}]", $selected). '</td>';
		$value =(isset($hmin[$i])) ? trim($hmin[$i]) : '';
		echo'<td><input type="text" name="min['.$i. ']"  value="'.$value.'"></td>';
		$value =(isset($hmax[$i])) ? trim($hmax[$i]) : '';
		echo'<td><input type="text" name="max['.$i. ']"  value="'.$value.'"></td>';
		$value =(isset($hlen[$i])) ? trim($hlen[$i]) : '';
		echo'<td><input type="text" name="len['.$i. ']"  value="'.$value.'"></td>';
		$value =(isset($hpref[$i])) ? trim($hpref[$i]) : '';
		echo'<td><input type="text" name="pref['.$i. ']" value="'.$value.'"></td>';
		$value =(isset($hsuf[$i])) ? trim($hsuf[$i]) : '';
		echo'<td><input type="text" name="suf['.$i. ']" value="'.$value.'"></td>';
		echo '</tr>';
	}
	echo '</table>';
	echo '<input type=submit value="実行">';
	echo '</form>';
}
include('page_footer.php');
// 選択肢配列からプルダウンリストを作る
function subject_select($options, $name, $selected){
	$str = '<select name="'.$name.'">';
	foreach ($options as $k => $v ){
		if ($k==$selected){
			$str .= '<option value="'.$k.'" selected>' . $v. ' </option>';
		}else{
			$str .= '<option value="'.$k.'">' .$v. ' </option>';
		}
	}
	return $str . '</select>';
}
?>