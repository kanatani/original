<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
<link rel="stylesheet" href="css/st.css">
<title>新規登録完了</title>
</head>
<body>

<?php 
$user_name = filter_input(INPUT_POST, 'user_name');
$gmail = filter_input(INPUT_POST, 'gmail', FILTER_VALIDATE_EMAIL);
$netpass = filter_input(INPUT_POST, 'netpass');

$user_name = htmlspecialchars($user_name);
$gmail = htmlspecialchars($gmail);
$netpass = htmlspecialchars($netpass);

$dsn = 'mysql:dbname=LAA1138637-db;host=mysql136.phy.lolipop.lan';
$user = 'LAA1138637';
$password = 'Naokiokane';
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
    $sql = 'INSERT INTO loguin (user_name,gmail,netpass) VALUES (:user_name, :gmail, :netpass)';
    $stmt = $dbh->prepare($sql);
    $stmt->BindValue(':user_name',$user_name);
    $stmt->BindValue(':gmail',$gmail);
    $stmt->BindValue(':netpass',$netpass);
    $stmt->execute();
    $smg = '登録が完了しました.';
    $link = '<a href="top.php" class="alert-link">トップページ</a>';
} 
else 
{
    $smg = '既に登録済みのメールアドレスです';
    $link = '<a href="sinki.html" class="alert-link">戻る</a>';
}
$dbh =null;
?>
<div id="insert">
    <div class="insert_info">
        <div class="alert alert-info insert_message" role="alert">
            <?php echo '<h3>'.$smg.'</h3>' ?>
            <?php echo $link ?>.
        </div>
    </div>
</div>
<?php
}
catch(PDOException $e) {
    print'接続されていません';
}
?>

<script src="js/bubbly-bg.js"></script>
<script>bubbly();</script>
</body>
</html>