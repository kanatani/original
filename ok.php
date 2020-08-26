<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/style.css">
<link rel="shortcut icon" href="favicon.ico">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<title>お問い合わせ</title>
</head>
<body>
<?php
try
{
$dsn = 'mysql:dbname=LAA1138637-db;host=mysql136.phy.lolipop.lan';
$user = 'LAA1138637';
$password = 'Naokiokane';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

$simei=$_POST['simei'];
$gmail=$_POST['gmail'];
$content=$_POST['content'];


$simei= htmlspecialchars($simei);
$gmail= htmlspecialchars($gmail);
$content= htmlspecialchars($content);

$sql='INSERT INTO toi(onamae,gmail,content) VALUES ("'.$simei.'","'.$gmail.'","'.$content.'")';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$dbh = null;

$mail_sub='マッチングアプリ[connecting]。アンケートを受け付けました。';
$mail_body=$simei."様へ\nアンケートご協力ありがとうございました。お客様のご意見を参考にしながら満足度の高いアプリを制作していきます。";
$mail_head="From:connecting.com";
mb_language('Japanese');
mb_internal_encoding("UTF-8");

mb_send_mail($gmail,$mail_sub,$mail_body,$mail_head);

?>
<div id="inquire">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Thank you for inquiring your opinion!
            </h3>
            <p class="card-text">頂いたご意見を元に改善していきます！</p>
            <a href="look.php" class="btn btn-primary">サイトに戻る</a>
        </div>
    </div>
</div>
<?php
}
catch(Exception $e)
{
    print'ただいま障害によりご迷惑をおかけしております。';
}
?>
<script type="text/javascript" src="js/app.js"></script>
<script src="js/bubbly-bg.js"></script>
<script>bubbly();</script>
</body>
</html>