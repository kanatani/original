<!doctype html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<title>ログアウト</title>
</head>
<body>
<div class="connect">
  <?php
  session_start();
  if (isset($_SESSION['id'])) {
    ?>
        <div class="alert alert-success thanks" role="alert">
          <h4 class="alert-heading">THANK YOU!</h4>
          <p>ログアウトしました！</p>
          <hr>
          <p class="mb-0 again"><a class="btn btn-primary" href="top.php" role="button">ログイン</a></p>
        </div>
    <?php
    } else {
      ?>
      <div class="alert alert-success thanks" role="alert">
        <h4 class="alert-heading">session切れ</h4>
        <p>ログアウトしました！</p>
        <hr>
        <p class="mb-0 again"><a class="btn btn-primary" href="top.php" role="button">ログイン</a></p>
      </div>
  <?php
    }
  $_SESSION = array();
  setcookie($_COOKIE[session_name()], '', time()-1);
  session_destroy();

  ?>
<script>
  
</script>
</div>
<script src="js/bubbly-bg.js"></script>
<script>bubbly();</script>
</body>
</html>