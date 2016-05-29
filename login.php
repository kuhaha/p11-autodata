<?php include('page_header.php'); ?>

<form class="form-horizontal" action="check.php" method="post">
  <div class="form-group has-warning">
    <label for="vs1" class="control-label col-sm-2 bg-warning">ユーザーID</label>
    <div class="col-sm-10"><input type="text" id="vs1" name="uid" class="form-control" placeholder="ログインID（英数の文字列）">
    </div>
  </div>
   <div class="form-group has-success">
    <label for="vs2" class="control-label col-sm-2 bg-success">パスワード</label>
    <div class="col-sm-10"><input type="password" id="vs2" name="upass" class="form-control" placeholder="パスワード">
    </div>
  </div>
  <div class="form-group has-error">
    <label for="vs3" class="control-label col-sm-2"><br></label>
    <div class="col-sm-10"><input class="btn btn-success btn-block" type="submit" value="ログイン">
    </div>
  </div>
</form>
<?php include('page_footer.php'); ?>