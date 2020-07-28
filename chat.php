<?php
session_start();
session_regenerate_id(true);

function connectDB() {
    $dsn = 'mysql:dbname=original;host=localhost';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn,$user,$password);
    $dbh->query('SET NAMES utf8');
    return $dbh;
}

function chat_select($chat_id) {
    $dbh = connectDB();
    $sql = 'SELECT * FROM chat WHERE user_id=:user_id and post_id=:post_id';
    $stmt = $dbh->prepare($sql);
    $stmt->BindValue(':user_id',$_SESSION['id']);
    $stmt->BindValue(':post_id',$chat_id);
    $stmt->execute();

    $chat = $stmt->fetch(PDO::FETCH_ASSOC);
    if (empty($chat)) {
        $room = mt_rand();
        $dbh = connectDB();
        $sql = 'INSERT INTO chat(room_id,user_id,post_id) VALUES ('.$room.','.$_SESSION['id'].','.$chat_id.'),('.$room.','.$chat_id.','.$_SESSION['id'].')';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $dbh = null;
    }
    $dbh = null;
}

function insert() {
    $dbh = connectDB();
    $sql = 'INSERT INTO chat(room_id,user_id,post_id) VALUES ('.$room.','.$_SESSION['id'].','.$com.'),('.$room.','.$com.','.$_SESSION['id'].')';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $dbh = null;
}

function match() {
    $dbh = connectDB();
    $sql = 'SELECT * FROM good AS t1 INNER JOIN good AS t2 ON t1.user_id = t2.com_id AND t1.com_id = :user_id';
    $stmt = $dbh->prepare($sql);
    $stmt->BindValue(':user_id',$_SESSION['id']);
    $stmt->execute();
    echo '<br>';
    while(1)
    {       
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if($rec==false)
        {
            break;
        }
            
        if(empty($rec)) {
            echo 'グットボタンを押してね';
        }
            if(!empty($rec)){
                
                if($_SESSION['id'] ==  $rec['user_id']) {
                    chat_select($rec['com_id']);
                }
            }
            
    }
    $dbh = null;
}

function image($com_id) {
    $dbh = connectDB();
    $sql = 'SELECT picture FROM sub WHERE pic_id=0 AND user_id=:user_id';
    $stmt = $dbh->prepare($sql);
    $stmt->BindValue(':user_id',$com_id);
    $stmt->execute();
    foreach ($stmt->fetch(PDO::FETCH_ASSOC) as $image) {
        echo $image;
    }
    $dbh = null;
}

function room() {
$dbh = connectDB();
$sql = 'SELECT  post_id, room_id , MAX(hour) FROM chat WHERE user_id=:user_id GROUP BY room_id ORDER BY MAX(hour) DESC';
$stmt = $dbh->prepare($sql);
$stmt->BindValue(':user_id',$_SESSION['id']);
$stmt->execute();

$i = 0;
while(1)
{       
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);

    if($rec==false)
    {
        break;
    }
    echo $rec['room_id'];
    $room = $rec['room_id'];
    ?>
    <div id = "pos">
        <ul class="message chatroom">
            <li>
                <div class="alert alert-light" role="alert">
                    <a href="newms.php?room=<?php echo $rec['room_id']; ?>" class="alert-link postname"　onclick="document.download<?php echo $i ;?>.submit();return false;">
                    <img src="<?php image($rec['post_id']) ?>" alt="">
                        ニックネーム: <?php image($rec['post_id']) ?>
                    </a>
                </div>
            </li>
        </ul>
    </div>
    <?php
    $i++;
}
$dbh = null;
}

?>

<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/style.css">
<title>チャット一覧</title>
</head>
<body id="whole">
<div class="container">
<nav id="global_navi">
    <ul>
        <li><a href="look.php">search</a></li>
        <li><a href="good.php">good</a></li>
        <li><a href="like.php">趣味</a></li>
        <li class="current"><a href="chat.php">チャット</a></li>
        <li><a href="pro.php">プロフィール</a></li>
    </ul>
</nav>

<?php   

try {
    match();
    room();

} 
catch(PDOException $e) {
    print'接続されていません';
}
?>

<script type="text/javascript" src="js/app.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
</body>
</html>