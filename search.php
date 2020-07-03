
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
    <form action="search.php" method="post">
        Name:<input type="text" name="simei">
        Mail:<input type="email" name="gmail">
        <input type="submit" value="検索">
    </form>

<?php
$simei =$_POST['simei'];

$dsn = 'mysql:dbname=original;host=localhost';
$user = 'root';
$password = '';
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

    <form>
        <table>
            <th>名前</th><th>メール</th>
            <?php foreach ($stmt as $row): ?>
            <tr><td><?php echo $row['simei'];?></td><td><?php echo $row['gmail'];?></td></tr>
            <?php endforeach; ?>
        </table>
    </form>


</div>
</body>
</html>