<?php include('page_header.php');
include('db_inc.php');
echo '<h2>テストデータの自動生成</h2>';
$hdai = array();
$hmin = array();
$hmax = array();
$hspace = array();


if (isset($_POST['snum'])){
	$snum  = $_POST['snum'];
	$enum    = $_POST['enum'];
}else if (isset($_POST['hid'])){
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
		$hspace[] = $row['space'];
	}
}
//print_r($hdai);
//print_r($hmin);
//print_r($hmax);
//print_r($hspace);


if (isset($snum) and isset($enum)){
	echo '<form action="result.php" method="post">';
	echo '<input type="hidden" name="snum" value="' .$snum. '">';
	echo '<input type="hidden" name="enum" value="' .$enum. '">';




	//echo $hist,$dnum,$enum;
	echo '<table border=1>';
	// SQL文実行
	$sql = 'SELECT * FROM tb_subject';
	$rs = mysql_query($sql, $conn);
	$option = array();
	while ( $row = mysql_fetch_array($rs) ) {
		$sid = $row['sid'];
		$sname = $row['sname'];
		$option[$sid] = $sname;
	}

	echo '<tr>';
	for($i=0;$i<$snum;$i++){
		echo'<td>項目名<select name="dai['.$i. ']">';
		foreach ($option as $k => $v ){
			$selected =(isset($hdai[$i])) ? trim($hdai[$i]) : -1;
			if ($k==$selected){
				echo '<option value="'.$k.'" selected>' . $v. ' </option>';
			}else{
				echo '<option value="'.$k.'">' .$v. ' </option>';
			}
		}
		echo '</select></td>';
	}
	echo '</tr>';

	echo '<tr>';
	for($i=0;$i<$snum;$i++){
		$value =(isset($hmin[$i])) ? trim($hmin[$i]) : 0;
		echo'<td>最小数<input type="text" name="min['.$i. ']"  value="'.$value.'" size=7></td>';
	}
	echo '</tr>';
	echo '<tr>';
	for($i=0;$i<$snum;$i++){
		$value =(isset($hmax[$i])) ? trim($hmax[$i]) : 0;
		echo'<td>最大数<input type="text" name="max['.$i. ']"  value="'.$value.'"  size=7></td>';
	}
	echo '</tr>';


	echo '<tr>';
	for($i=0;$i<$snum;$i++){
		$value =(isset($hmax[$i])) ? trim($hmax[$i]) : 0;
		echo'<td>長さ<input type="text" name="len['.$i. ']"  value="'.$value.'"  size=7></td>';
	}
	echo '</tr>';


	echo '<tr>';
	for($i=0;$i<$snum;$i++){
		$value =(isset($hmax[$i])) ? trim($hmax[$i]) : 0;
		echo'<td>前書き文字<input type="text" name="pref['.$i. ']"  size=7></td>';
	}
	echo '</tr>';


	echo '<tr>';
	for($i=0;$i<$snum;$i++){
		$value =(isset($hmax[$i])) ? trim($hmax[$i]) : 0;
		echo'<td>後書き文字<input type="text" name="suf['.$i. ']"  size=7></td>';
	}
	echo '</tr>';


	//

/*
	echo '<tr>';
    for($i=0;$i<$snum;$i++){
	//    $value =(isset($hmax[$i])) ? trim($hmax[$i]) : 0;
		echo '<td>区切<input type="text" name="space['.$i.']"  value=""  size=7></td>';
    }
	echo '</tr>';
	for($i=0;$i<$snum;$i++):

	?>



	<?php
	endfor;
	echo '</tr>';
*/
//	echo '<tr>';
//	for($i=0;$i<$snum;$i++){
//	}
//	echo '</tr>';
	echo '<tr><td>';
	$subjects=array(
		'txt'=>'テキスト',
		'sql'=>'SQL出力'
	);
	$current='txt';
	foreach($subjects as $id=>$name){
		if($id==$current){
			echo'<input type="radio" name="out" value="'.$id.'" checked>'.$name;
		}else{
			echo'<input type="radio" name="out" value="'.$id.'">'.$name;
		}
	}

	echo '</td></tr>';
	echo '</table>';

	echo '<input type=submit value="実行">';
	echo '</form>';
	// 画面遷移
	//header('Location:login.php');//一覧へ画面遷移
}
?>
<p><?php
if(isset($_SESSION['uid'])){
	echo '<a href="logout.php">ログアウト</a>';
}
echo '<p><a href="login_input_1.php">項目選択画面に戻る</a>';
include('page_footer.php');
?>