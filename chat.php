<?php
session_start();
session_regenerate_id(true);

function connectDB() {
    $dsn = 'mysql:dbname=LAA1138637-db;host=mysql136.phy.lolipop.lan';
    $user = 'LAA1138637';
    $password = 'Naokiokane';
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

function com_human($her) {
    $dbh = connectDB();
    $sql = 'SELECT * FROM human WHERE user_id=:user_id';
    $stmt = $dbh->prepare($sql);
    $stmt->BindValue(':user_id',$her);
    $stmt->execute();
    while(1)
    {       
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if($rec==false)
        {
            break;
        }
            echo $rec['simei'];
        
            
    }
    
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
    $room = $rec['room_id'];
    ?>
    <div id = "pos">
        <ul class="message ">
            <li>
                <div id="chat_room">
                    <a href="newms.php?room=<?php echo $rec['room_id']; ?>&simei=<?php echo $rec['post_id']; ?>" class="alert-link postname"　onclick="document.download<?php echo $i ;?>.submit();return false;">
                    <img src="<?php image($rec['post_id']) ?>" alt="">
                        ニックネーム: <?php com_human($rec['post_id']) ?>
                    </a>
                </div>
            </li>
            <br>
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
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="css/st.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<title>チャット一覧</title>
</head>
<body id="whole">
<header>
    <nav id="global_navi" class = "nav">
                <ul>
                    <li>
                        <a href="look.php">
                            <i class="fas fa-search"></i>
                                探す
                        </a>
                    </li>
                    <li>
                        <a href="good.php">
                            <i class="fas fa-thumbs-up"></i>
                                いいね 
                        </a>
                    </li>
                    <li>
                        <a href="like.php">
                            <i class="far fa-kiss-wink-heart"></i>
                                趣味
                        </a>
                    </li>
                    <li class="current">
                        <a href="chat.php">
                            <i class="fas fa-comments"></i>
                                チャット
                        </a>
                        </li>
                    <li >
                        <a href="pro.php">
                            <i class="fas fa-user-alt"></i>
                                プロフィール
                        </a>
                    </li>
                    <li><a href="#">その他</a>
                    <ul id="ot">
                        <li id="other">
                            <a href="toi.php">
                                <i class="fas fa-question-circle"></i>
                                    お問い合わせ
                            </a>
                        </li>
                        <li id="other">
                            <a href="out.php">
                                <i class="fas fa-sign-out"></i>
                                    ログアウト
                            </a>
                        </li>
                    </ul>
                    </li>
                </ul>
        </nav>
    </header>
<div class="container">
        
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
<script src="js/bubbly-bg.js"></script>
<script>bubbly();</script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
</body>
</html>