<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>新規登録完了</title>
</head>
<body>
<div class="container">
<?php 
$userid = filter_input(INPUT_POST, 'userid');
$gmail = filter_input(INPUT_POST, 'gmail', FILTER_VALIDATE_EMAIL);
$netpass = filter_input(INPUT_POST, 'netpass');

$userid = htmlspecialchars($userid);
$gmail = htmlspecialchars($gmail);
$netpass = htmlspecialchars($netpass);

$dsn = 'mysql:dbname=original;host=localhost';
$user = 'root';
$password = '';
try
{
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

$sql = 'SELECT * FROM loguin WHERE gmail = :gmail';
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':gmail', $gmail);
$stmt->execute();   

$rec = $stmt->fetch(PDO::FETCH_ASSOC);

if(!isset($rec['gmail'])) {  
    $sql = 'INSERT INTO loguin (userid,gmail,netpass) VALUES (:userid, :gmail, :netpass)';
    $stmt = $dbh->prepare($sql);
    $stmt->BindValue(':userid',$userid);
    $stmt->BindValue(':gmail',$gmail);
    $stmt->BindValue(':netpass',$netpass);
    $stmt->execute();
    $smg = '登録が完了しました.';
    $link = '<a href="top.php">トップページ</a>';
} 
else 
{
    $smg = '既に登録済みのメールアドレスです';
    $link = '<a href="sinki.html">戻る</a>';
}
$dbh =null;
echo '<h3>'.$smg.'</h3>';
echo $link;
}

catch(PDOException $e) {
    print'接続されていません';
}
?>
</div>
</body>
</html>