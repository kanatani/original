<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<title>お問い合わせ</title>
</head>
<body>
<?php
try
{
$dsn='mysql:dbname=original;host=localhost';
$user='root';
$password='';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

$simei=$_POST['simei'];
$gmail=$_POST['gmail'];
$content=$_POST['content'];

$simei= htmlspecialchars($simei);
$gamil= htmlspecialchars($gmail);
$content= htmlspecialchars($content);

$sql='INSERT INTO toi(simei,gmail,content) VALUES ("'.$simei.'","'.$gmail.'","'.$content.'")';

$stmt = $dbh->prepare($sql);
$stmt->execute();

?>
<div class="container">
    <h4>お問い合わせのご協力ありがとうございました。</h4>
    <br>
    <h4>またこちらから連絡いたしますので少々お待ちください。</h4>
    <a href="toi.php">戻る</a>
</div>
<?php
}
catch(Exception $e)
{
    print'ただいま障害によりご迷惑をおかけしております。';
}
?>
</body>
</html>