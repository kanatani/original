<!doctype html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<title>ログイン確認</title>
</head>
<body>
<div class="container">
<?php
$netpass = filter_input(INPUT_POST, 'netpass');
$gmail = filter_input(INPUT_POST, 'gmail', FILTER_VALIDATE_EMAIL);

$dsn = 'mysql:dbname=original;host=localhost';
$user = 'root';
$password = '';
try
{
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');
} catch(PDOException $e) {
    print'接続されていません';
}
$sql = 'SELECT * FROM loguin WHERE gmail = :gmail AND netpass = :netpass';
$stmt = $dbh->prepare($sql);
$stmt->BindValue(':gmail',$gmail);
$stmt->BindValue(':netpass',$netpass);
$stmt->execute();

$member = $stmt->fetch(PDO::FETCH_ASSOC);

if (!isset($member['netpass'])) {
    echo '新規登録をお願いします。';
    echo '<a href="sinki.html">新規登録</a>';
}
else 
{
    session_start();
    session_regenerate_id(true);
    $_SESSION['simei'] = $member['userid'];
    $_SESSION['code'] = $member['code'];
    echo $_SESSION['simei'];
    echo $_SESSION['code'];
    echo '<h3>ログインを確認しました。</h3>';
    echo '<a href="newms.php">チャット</a>';
    echo '<a href="out.php">ログアウト</a>';
}
$dbh =null;
?>
</div>
</body>
</html>