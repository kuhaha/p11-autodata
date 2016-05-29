<?php
include('page_header.php');
include('db_inc.php');
if(isset($_SESSION['uid'])){
	$uid=$_SESSION['uid'];
	$uname=$_SESSION['uname'];
}
?>
<form class="form-horizontal" action="random.php" method="post">
  <div class="form-group has-success">
    <label for="vs1" class="control-label col-sm-2 bg-success">履歴選択</label>
    <div class="col-sm-10">
    	<select id="vs1" name="hid"  class="form-control">
		<?php
			$sql = "SELECT * FROM tb_history where uid='{$uid}'";
			$rs = mysql_query($sql, $conn);
			if ($rs) $row = mysql_fetch_array($rs);
			while ( $row ){
				$hid = $row['hid'];
				$hname = $row['hname'];
				$hdate = $row['hdate'];
			 	echo '<option value="'. $hid . '">'  .$hname .'(' .$hdate. ')'. '</option>';
			 	$row = mysql_fetch_array($rs);
			}
		 ?>
		</select>
    </div>
  </div>
  <div class="form-group has-warning">
    <label for="vs2" class="control-label col-sm-2 bg-info">履歴利用</label>
    <div class="col-sm-10"><input class="btn btn-primary btn-block" type="submit" id="vs2" name="a" value="次へ"/>
</div>
  </div>
 </form>
<?php include('page_footer.php'); ?>