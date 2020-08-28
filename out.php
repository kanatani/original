<?php
session_start();

?>

<!doctype html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/style.css">
<link rel="shortcut icon" href="favicon.ico">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<title>ログアウト</title>
</head>
<body>
  <?php
  try
    {
  ?>
<div class="connect">
  <?php
  
  if (isset($_SESSION['id'])) {
    $_SESSION = array();
  setcookie($_COOKIE[session_name()], '', time()-1);
  session_destroy();
    ?>
        <div class="alert alert-success thanks" role="alert">
          <h4 class="alert-heading">THANK YOU!</h4>
          <p>ログアウトしました！</p>
          <hr>
          <p class="mb-0 again"><a class="btn btn-primary" href="top.php" role="button">ログイン</a></p>
        </div>
    <?php
    } else {
      $_SESSION = array();
      setcookie($_COOKIE[session_name()], '', time()-1);
      session_destroy();
      ?>
      <div class="alert alert-success thanks" role="alert">
        <h4 class="alert-heading">session切れ</h4>
        <p>ログアウトしました！</p>
        <hr>
        <p class="mb-0 again"><a class="btn btn-primary" href="top.php" role="button">ログイン</a></p>
      </div>
  <?php
    }
    
  ?>
<script>
  
</script>
</div>
<script src="js/bubbly-bg.js"></script>
<?php
}
catch(PDOException $e) {
    print'<h2 class="error">接続されていません</h2>';
}
?>
<script>bubbly();</script>
</body>
</html>