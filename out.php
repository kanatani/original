<!doctype html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<title>ログアウト</title>
</head>
<body>
<div class="container">
<?php
session_start();
if (isset($_SESSION["simei"])) {
    echo 'Logoutしました。';
  } else {
    echo 'SessionがTimeoutしました。';
  }
$_SESSION = array();
setcookie($_COOKIE[session_name()], '', time()-1);
session_destroy();

?>
<a href="top.php">ログイン</a>
</div>
</body>
</html>