<?php include('page_header.php'); ?>
<h2>ストデータの必要な発生数</h2>
<form class="form-horizontal" action="random.php" method="post">
  <div class="form-group has-success">
    <label for="vs1" class="control-label col-sm-2 bg-info">項目数</label>
    <div class="col-sm-10"><input type="text" id="vs1" name="snum" class="form-control" placeholder="半角整数">
    </div>
  </div>
  <div class="form-group has-warning">
    <label for="vs2" class="control-label col-sm-2 bg-danger">発生数</label>
    <div class="col-sm-10"><input type="text" id="vs2" name="enum" class="form-control" placeholder="半角整数"></div>
  </div>
  <div class="form-group has-error">
  <label for="vs1" class="control-label col-sm-2 bg-warning"><br></label>
    <div class="col-sm-10"><input class="btn btn-primary btn-block" type=submit value="次へ"></div>
  </div>
</form>

<?php include('page_footer.php'); ?>