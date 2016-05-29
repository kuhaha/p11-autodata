<?php include('page_header.php'); ?>
<h2>題材登録</h2>
<form class="form-horizontal"  action="subject_save.php" method="post" enctype="multipart/form-data">
  <div class="form-group has-success">
    <label for="vs1" class="control-label col-sm-2 bg-info">題材名</label>
    <div class="col-sm-10"><input type="text" id="vs1" name="sname" class="form-control" placeholder="題材の日本語名、例えば、役職名、道具名">
    </div>
  </div>
  <div class="form-group has-danger">
    <label for="vs2" class="control-label radio-inline col-sm-2 bg-danger">ジャンル</label>
    <label class="radio-inline"><input type="radio" name="type" value="1" checked>一般</label>
    <label class="radio-inline"><input type="radio" name="type" value="2">乱数</label>
  </div>
    <div class="form-group has-error">
    <label for="vs3" class="control-label col-sm-2 bg-success">ファイル</label>
    <div class="col-sm-10"><input type="file" name="myfile"></div>
  </div>
  <div class="form-group has-error">
    <label for="vs4" class="control-label col-sm-2"></label>
    <div class="col-sm-10"><input class="btn btn-success btn-lg" type=submit value="登録">
    <input class="btn btn-primary btn-lg" type="reset" value="取消">
    </div>
  </div>
</form>

<?php　include('page_footer.php');　?>