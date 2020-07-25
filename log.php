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

function img() {
    $dsn = 'mysql:dbname=original;host=localhost';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn,$user,$password);
    $dbh->query('SET NAMES utf8');
    $sql = 'SELECT * FROM sub WHERE user_id = :user_id AND pic_id = :pic_id';
    $stmt = $dbh->prepare($sql);
    $stmt->BindValue(':user_id',$_SESSION['id']);
    $stmt->BindValue(':pic_id',0);
    $stmt->execute();

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    $_SESSION['picture'] = $rec['picture'];
}

    
try
{
    $dsn = 'mysql:dbname=original;host=localhost';
    $user = 'root';
    $password = '';
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
    $_SESSION['id'] = $member['id'];
    $_SESSION['user_name'] = $member['user_name'];
    img();
    ?>
    <div class="jumbotron jumbotron-fluid">
    <div class="container welcome">
        <h1 class="display-4">ようこそ<?php echo $_SESSION['user_name'];?>さん!</h1>
        <p class="lead">ログインを確認しました</p>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                start
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="pro.php">mylist</a>
                <a class="dropdown-item" href="look.php">search</a>
                <a class="dropdown-item" href="out.php">logout</a>
            </div>
        </div>
    </div>
    </div>
    <?php
}
$dbh =null;
?>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>