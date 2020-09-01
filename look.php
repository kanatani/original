<?php
session_start();
try
{

function connect() {
    $dsn = 'mysql:dbname=LAA1138637-db;host=mysql136.phy.lolipop.lan';
    $user = 'LAA1138637';
    $password = 'Naokiokane';
    $dbh = new PDO($dsn,$user,$password);
    $dbh->query('SET NAMES utf8');
    return $dbh;
    //$dsn = 'mysql:dbname=LAA1138637-db;host=mysql136.phy.lolipop.lan';
    //$user = 'LAA1138637';
    //$password = 'Naokiokane';
    //$dbh = new PDO($dsn,$user,$password);
    //$dbh->query('SET NAMES utf8');
    //return $dbh;
    
    }

function select() {
    $dbh = connect();
    $sql = 'SELECT * FROM sub JOIN human ON sub.user_id=human.user_id WHERE pic_id=0 and human.user_id NOT IN ('.$_SESSION['id'].')';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    while(1) {
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if($rec==false) {
        break;
        }
        ?>
        <div class="li">
        <form id="form" action="syou.php" method="post">
        <div class="list">
        <div class="list_img">
        <input type="hidden" name="her_id" value="<?php echo $rec['user_id']; ?>">
        <input type="image" class="img" src="<?php echo $rec['picture']; ?>" alt="">
        </form>
        <div class="card-body list-text">
        <p class="card-text"><?php echo $rec['simei']; echo "<br>"; echo $rec['age']; echo "歳"; ?></p>
        </div>
        </div>
        </div>
        </form>
        </div>
        <?php
    }
}

    $dbh = null;
?>

<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/st.css">
<link rel="shortcut icon" href="favicon.ico">
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@200&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<title>ユーザー一覧</title>
</head>
<body>
    <?php
    
    ?>
    <header>
    <nav id="global_navi" class = "nav">
                <ul>
                    <li class="current">
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
                    <li>
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
<div class="container nav">
<div class="looking_user">
    <h2 class="look_text">Looking for friends.</h2>
<?php
select();

?>
</div>
</div>
<script src="js/app.js"></script>
<?php
}
catch(PDOException $e) {
    print'<h2 class="error">ただいま障がいによりご迷惑をおかけしております。</h2>';
}
?>
<script src="js/bubbly-bg.js"></script>
<script>bubbly();</script>
</body>
</html>