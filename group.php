<?php
session_start();
function connect() {
$dsn = 'mysql:dbname=LAA1138637-db;host=mysql136.phy.lolipop.lan';
$user = 'LAA1138637';
$password = 'Naokiokane';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');
return $dbh;
}

function select() {
    $dbh = connect();
    $sql = 'SELECT * FROM sub JOIN human ON sub.user_id=human.user_id WHERE pic_id=0';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    while(1) {
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if($rec==false) {
        break;
        }
        ?>
        <div class="li">
        <form id="form" action="group.php" method="post">
        <div class="col list">
        <div class="card" style="width: 18rem;">
        <input type="hidden" name="her_id" value="<?php echo $rec['user_id']; ?>">
        <input type="image" class="img" src="<?php echo $rec['picture']; ?>" alt="">
        </form>
        <div class="card-body list-text">
        <p class="card-text"><?php echo $rec['simei'];  echo $rec['age']; ?></p>
        </div>
        </div>
        </div>
        </form>
        </div>
        <?php
    }
}
?>

<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/st.css">
<link rel="shortcut icon" href="favicon.ico">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<title>カード一覧</title>
</head>
<body>
<div class="container">
<nav id="global_navi">
    <ul>
        <li class="current"><a href="look.php">search</a></li>
        <li><a href="good.php">good</a></li>
        <li><a href="like.php">趣味</a></li>
        <li><a href="chat.php">チャット</a></li>
        <li><a href="pro.php">プロフィール</a></li>
    </ul>
</nav>
<form action="hobby.php" method="post">
    <input type="hidden" value="">
    <input type="image" src="img/IMG_0917.jpeg">
</form>

</div>
</body>
</html>