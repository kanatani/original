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

function insert() {
    $category=$_POST['category'];
    $card=$_POST['card'];
    $types=$_POST['types'];

    $card=htmlspecialchars($card);

    $dbh = connect();
    $sql = 'SELECT * FROM life_style WHERE hobby_card = :hobby_card';
    $stmt = $dbh->prepare($sql);
    $stmt->BindValue(':hobby_card',$card);
    $stmt->execute();
    $rec = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(empty($rec))
        {
            if(isset($_FILES) && isset($_FILES['upload']) && is_uploaded_file($_FILES['upload']['tmp_name'])) {
                if(!file_exists('hobby')){
                    mkdir('hobby');
                }
                $a = 'hobby/' . basename($_FILES['upload']['name']);
                    if(move_uploaded_file($_FILES['upload']['tmp_name'],$a)) {
                        $dbh = connect();
                        $sql = 'INSERT INTO life_style (hobby_card,picture,com_id,category,types,like_count) VALUES ("'.$card.'","'.$a.'","'.$_SESSION['id'].'","'.$category.'","'.$types.'","1" )';
                        $stmt = $dbh->prepare($sql);
                        $stmt->execute();
                        $dbh = null;
                        header('Location: http://original-nao.jp/like.php');
                    }
                else 
                {
                    echo '失敗';
                }
        }
    }
    else {
        echo '';
    }
}

if(isset($_POST["send"])) {
    insert();
}



?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/st.css">
<link rel="shortcut icon" href="favicon.ico">
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@500;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<title>カード一覧</title>
<style>
.cardselect 
{
    font-family: 'Noto Sans JP', sans-serif;
}
</style>
</head>
<body> 
<?php
try
{
?>
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
                    <li>
                        <a href="chat.php">
                            <i class="fas fa-comments"></i>
                                チャット
                        </a>
                        </li>
                    <li class="current">
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
    <div id="make_card">
        <form action="pic_insert.php" method="post" id = "make_form" enctype="multipart/form-data">
        <h3 class="cardselect">カード作成</h3>
            <label>
                <span class="filelabel">
                    <i class="fas fa-camera fa-2x"></i>
                    選択
                </span>
                <input type="file" class ="request" name="upload" id="filesend" required>
            </label>

            <select name="category" id="cate" class="form-control form-control-sm request">
                <option value="in">インドア</option>
                <option value="out">アウトドア</option>
            </select>
            <select name="types" id="type" class ="request" class="form-control form-control-sm">
                <option value="like">like</option>
                <option value="bad">bad</option>
            </select>
            <br>
            <br>
            <label for="text_top" id="title">タイトル</label>
            <input type="text" id="text_top" name="card" placeholder="タイトルを入力" required>
            <div class="text_underline"></div>
            <input type="submit" name = "send" id="file_submit" class="btn btn-outline-info request" value="送信">
        </form>
    </div>
</div>
<script language="javascript" type="text/javascript">
    $(function(){
        $('#text_top').focus(function(){
            $('#title').animate({'color': '#3be5ae'},500);
        }).blur(function(){
            $('#title').animate({'color': 'black'},500);
        });
    });
</script>
<script src="js/bubbly-bg.js"></script>
<?php
}
catch(PDOException $e) {
    print'<h2 class="error">ただいま障がいによりご迷惑をおかけしております。</h2>';
}
?>
<script>bubbly();</script>
</body>
</html>