<?php include('page_header.php');?>

<h2>アカウント新規登録</h2>
<form class="form-horizontal" action="saveuser.php" method="post">
  <div class="form-group has-success">
    <label for="vs1" class="control-label col-sm-2 bg-danger">お名前</label>
    <div class="col-sm-10"><input type="text" id="vs1" name="uname" class="form-control" placeholder="氏名を日本語、英語で入力してください">
    </div>
  </div>
  <div class="form-group has-warning">
    <label for="vs2" class="control-label col-sm-2 bg-warning">ユーザーID</label>
    <div class="col-sm-10"><input type="text" id="vs2" name="uid" class="form-control" placeholder="ログインID（英数の文字列）">
    </div>
  </div>
   <div class="form-group has-success">
    <label for="vs1" class="control-label col-sm-2 bg-success">パスワード</label>
    <div class="col-sm-10"><input type="password" id="vs1" name="password1" class="form-control" placeholder="パスワード">
    </div>
  </div>
  <div class="form-group has-success">
    <label for="vs1" class="control-label col-sm-2 bg-info">パスワード確認</label>
    <div class="col-sm-10"><input type="password" id="vs1" name="password2" class="form-control" placeholder="パスワード">
    </div>
  </div>
  <div class="form-group has-error">
    <label for="vs4" class="control-label col-sm-2"><br></label>
    <div class="col-sm-5"><input class="btn btn-success btn-block" type="submit" value="登録">
    </div>
    <div class="col-sm-5"><input class="btn btn-primary btn-block" type="reset" value="取消">
    </div>
  </div>
</form>
<?php include('page_footer.php'); ?>