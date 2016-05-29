<?php include('page_header.php');
include('db_inc.php');
if(isset($_SESSION['uid'])){
	$uid=$_SESSION['uid'];
	$uname=$_SESSION['uname'];
}
$snum = $_POST['snum'];
$enum = $_POST['enum'];
$dai = $_POST['dai'];

$min = $_POST['min'];
$max = $_POST['max'];
$len = $_POST['len'];
$pref = $_POST['pref'];
$suf = $_POST['suf'];

$ds ='(';
$i = 0;
foreach($dai as $d){
	$ds .= ($i>0)? ',' . $d : $d;
	$i++;
}
$ds .= ')';
//echo $ds;
$type = array();
$sname = array();
$sql = 'SELECT * FROM tb_subject WHERE sid in '. $ds;
$rs = mysql_query($sql, $conn);
while ( $row = mysql_fetch_array($rs) ) {
	$sid = $row['sid'];
	$type[$sid] = $row['type'];
	$sname[$sid] = $row['sname'];
}
$option = array();
$i=0;
foreach($dai as $d){
	if ($type[$d]==1){
		$sql = 'SELECT * FROM tb_element WHERE sid='.$d.' ORDER BY rand() LIMIT '.$enum.';';
		$rs = mysql_query($sql, $conn);
		$number_pref= stripslashes($pref[$i]);
		$number_suf=  stripslashes($suf[$i]);
		$o = array();
		while ( $row = mysql_fetch_array($rs) ) {
			$ename = $row['ename'];
			$o[] = $number_pref . $ename . $number_suf;

		}
		$option[] = $o;

	}else if ($type[$d]==2){
		//echo '乱数の項目です';
		$number_min=  (int)$min[$i];
		$number_max=  (int)$max[$i];
		$number_len=  (int)$len[$i];
		$number_pref= stripslashes ($pref[$i]);
		$number_suf=  stripslashes ($suf[$i]);
		$o = array();
		for($j=0; $j<$enum; $j++){
			 $r =rand($number_min,$number_max);
			 $r = str_pad($r, $number_len, "0", STR_PAD_LEFT);
			 $o[] = $number_pref . $r . $number_suf;
		}
		$option[] = $o;
		//echo $o;
	} else if ($type[$d]==3){
		//echo 'シルアルナンバーの項目です';
		$number_min=  (int)$min[$i];
		$number_max=  (int)$max[$i];
		$number_len=  (int)$len[$i];
		$number_pref= stripslashes($pref[$i]);
		$number_suf=  stripslashes($suf[$i]);
		$o = array();
		$r = $number_min;
		for($j=0; $j<$enum; $j++){
			 $s = str_pad($r, $number_len, "0", STR_PAD_LEFT);
			 $o[] = $number_pref . $s . $number_suf;
			 $r++;
		}
		$option[] = $o;

	}
	$i++;
}

echo '<table class="table table-condensed table-stripped">';
echo '<tr class="bg-danger">';
foreach($dai as $sid) echo '<th>' . $sname[$sid]. '</th>';
echo '<tr>';
for($i=0; $i<$enum; $i++){
	echo '<tr>';
	for($j=0; $j<$snum; $j++){
		if(empty($option[$j][$i])){
			$k = rand(0,count($option[$j])-1);
			echo '<td>' . $option[$j][$k] . '</td>';
		}else{
			echo '<td>' . $option[$j][$i] . '</td>';
		}
	}
	echo '</tr>';
}
echo '<tr class="bg-danger">';
foreach($dai as $sid) echo '<th>' . $sname[$sid]. '</th>';
echo '<tr>';
echo '</table>';
?>
<form action="savehist.php" method="post">
<p>
履歴名：
<input type="text" name="hist" value="" />
<input type="hidden" name="snum" value="<?php echo $snum;?>"/>
<?php
foreach ($dai as $d){
	echo '<input type="hidden" name="dai[]" value="'.$d.'"/>';
}
for($i=0; $i<$snum; $i++){
	echo '<input type="hidden" name="min[]" value="'.$min[$i].'"/>';
	echo '<input type="hidden" name="max[]" value="'.$max[$i].'"/>';
	echo '<input type="hidden" name="len[]" value="'.$len[$i].'"/>';
	echo '<input type="hidden" name="pref[]" value="'.$pref[$i].'"/>';
	echo '<input type="hidden" name="suf[]" value="'.$suf[$i].'"/>';
}
?>
<input type="hidden" name="enum" value="<?php echo $enum;?>"/>
<input type="submit" name="a" value="保存"/>
<input type="reset" value="取消"/>
</form>

<?php include('page_footer.php'); ?>
