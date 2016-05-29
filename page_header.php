<?php  session_start(); ?>
<!DOCTYPE html>
<html lang="ja"><head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> AutoData: テストデータ自動生成</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
<div class="navbar navbar-inverse bg-primary">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">ナビゲーションの切替</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand"　href="index.php"><code>AutoData</code></a>
    </div>
    <!-- /.navbar-header -->
    <div class="navbar-collapse collapse">
    <ul class="nav navbar-nav">
    <li><a href="index.php">ホーム</a></li>
<?php
  if(isset($_SESSION['uid'])){
    $uid = $_SESSION['uid'];
    $utype = $_SESSION['utype'];
    $uname = $_SESSION['uname'];
    if ($utype == 9){//管理者のみ
      echo '<li><a href="subject_input.php">題材追加</a></li>';
    }
    include('db_inc.php');
    $sql = "SELECT * FROM tb_history where uid='{$uid}'";
    $rs = mysql_query($sql, $conn);
    $has_rireki = mysql_num_rows ($rs);
    if ($has_rireki > 0){
      echo '<li><a href="history_reuse.php">履歴利用('.$has_rireki.')</a></li>';
    }else{
      echo '<li><a disabled title="利用可能な履歴なし">履歴利用('.$has_rireki.')</a></li>';
    }
    echo '<li><a href="logout.php">ログアウト</a></li>';
  }else{
    echo '<li><a href="newuser.php" title="ユーザ登録すると履歴の保存・再利用ができる">ユーザ登録</a></li>';
    echo '<li><a href="login.php">ログイン</a></li>';
  }
?>
　　</ul>
</div>
</div>
</div>
<div class="container">