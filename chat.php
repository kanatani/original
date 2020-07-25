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
session_start();
session_regenerate_id(true);

try {
    function connectDB() {
        $dsn = 'mysql:dbname=original;host=localhost';
        $user = 'root';
        $password = '';
        $dbh = new PDO($dsn,$user,$password);
        $dbh->query('SET NAMES utf8');
        return $dbh;
    }


    function match() {
        $dbh = connectDB();
        $sql = 'SELECT * FROM good WHERE user_id = :user_id';
        $stmt = $dbh->prepare($sql);
        $stmt->BindValue(':user_id',$_SESSION['id']);
        $stmt->execute();
        $s=0;
        while(1)
        {       
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if($rec==false)
            {
                break;
            }
    
            echo $rec['com_id'];
            
            $sql = 'SELECT * FROM good WHERE user_id = :user_id';
            $stmt = $dbh->prepare($sql);
            $stmt->BindValue(':user_id',$rec['com_id']);
            $stmt->execute();

            $recs = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if(!isset($recs)) {
                echo 'madamada';
            }
            if(isset($recs)){
                if($_SESSION['id'] == $recs['com_id'] && $recs['user_id'] == $rec['com_id']) {
                    insert();
                }
            }
        }
        $dbh = null;
    }

    function insert() {
        global $i;
        $i.$name = mt_rand();
        $dbh = connectDB();
        $sql = 'INSERT INTO chat(room_id,user_id) VALUES (:room_id,:user_id)';
        $stmt = $dbh->prepare($sql);
        $stmt->BindValue(':room_id',$i.$name);
        $stmt->BindValue(':user_id',$_SESSION['id']);
        $stmt->execute();
        $dbh = null;
        
    }

    function image() {
        $dbh = connectDB();
        $sql = 'SELECT picture FROM sub WHERE pic_id=0 AND user_id=:user_id';
        $stmt = $dbh->prepare($sql);
        $stmt->BindValue(':user_id',145);
        $stmt->execute();
        foreach ($stmt->fetch(PDO::FETCH_ASSOC) as $image) {
            echo $image;
        }
        $dbh = null;
    }

    function room() {
    $dbh = connectDB();
    $sql = 'SELECT  room_id , MAX(hour) FROM chat WHERE user_id=:user_id GROUP BY room_id ORDER BY MAX(hour) DESC';
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
                        <img src="<?php image() ?>" alt="">
                            名前
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