<?php
try {
session_start();
$dsn = 'mysql:dbname=LAA1138637-db;host=mysql136.phy.lolipop.lan';
$user = 'LAA1138637';
$password = 'Naokiokane';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

$onamae=$_POST['onamae'];
$lived=$_POST['lived'];
$live=$_POST['live'];
$age=$_POST['age'];
$learn=$_POST['learn'];
$job=$_POST['job'];
$intro=$_POST['intro'];


$onamae=htmlspecialchars($onamae);
$live=htmlspecialchars($live);
$lived=htmlspecialchars($lived);
$age=htmlspecialchars($age);
$learn=htmlspecialchars($learn);
$job=htmlspecialchars($job);
$intro=htmlspecialchars($intro); 


$sql = 'REPLACE INTO human (user_id,simei,lived,live,age,learn,job,intro) VALUES ("'.$_SESSION['id'].'","'.$onamae.'","'.$lived.'","'.$live.'","'.$age.'","'.$learn.'","'.$job.'","'.$intro.'")';
$stmt = $dbh->prepare($sql);
$stmt->execute();

header('Location: http://localhost/original/subject/look.php');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<title>自己紹介</title>
</head>
<body>
<div class="container">

<a href="intro.php">戻り</a>
<a href="look.php">探す</a>

    <?php 
} 
catch (expection $e) 
{
    echo 'エラーです';
}
?>
</div>
<script src="js/bubbly-bg.js"></script>
<script>bubbly();</script>
</body>
</html>

