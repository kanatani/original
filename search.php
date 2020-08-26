<?php
$simei =$_POST['simei'];

$dsn = 'mysql:dbname=LAA1138637-db;host=mysql136.phy.lolipop.lan';
$user = 'LAA1138637';
$password = 'Naokiokane';
try
{
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

echo $simei;

$sql = 'SELECT * FROM loguin WHERE simei LIKE :simei';

if ($_POST['simei'] != "" OR $_POST['gmail'] != "") {
    $stmt = $dbh->prepare($sql);
    $stmt->BindValue(':simei',$simei);
    $stmt->execute();
} else {
    echo "検索できませんでした。";
}

} catch(PDOException $e) {
    print'接続されていません';
}
?>
<!doctype html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<title>検索機能</title>
</head>
<body>
<div class="container">


</div>
</body>
</html>