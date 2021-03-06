<?php
session_start();
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
<title>アップロード</title>
</head>
<body>
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
<div class="container">
<?php
try {
//画像アップロード

for($i=0; $i<=5;$i++){
    if (!empty($_FILES['file'.$i.''] ['tmp_name'])){
        if(is_uploaded_file($_FILES['file'.$i.''] ['tmp_name'])) {
            if (! file_exists('upload')) {
                mkdir ('upload');
            }
            $file = 'upload/' . basename($_FILES['file'.$i.'']['name']);
            $id = $i;
            if (move_uploaded_file($_FILES['file'.$i.'']['tmp_name'], $file)) {
                $msg = 'こちらの写真に設定しますか?';
                echo '<div id="galleries">';
                echo '<h1>画像確認</h1>';
                echo '<div class="upload">';
                echo '<img src="',$file,'" id="'.$i.'">';
                echo '</div>';
                echo '</div>';
                
            } else {
                $msg = 'アップロードに失敗しました';
            }
        } else {
            echo '問題';
            var_dump($_FILES['file'.$i.''] ['tmp_name']);
        }
        if (isset($msg) && $msg == true) {
        echo '<p>'. $msg . '</p>';
        
        }
    } 
}

    ?>
    <div>
        <form id="image" action="up.php" method="post" enctype="multipart/form-data">
        <input type="button" onclick="history.back()" class="btn btn-info mr-1" value="戻る">
        <input name="up" type="hidden" value="<?php echo $file ;?>">
        <input name="key" type="hidden" value="<?php echo $id ;?>">
        <input name="send" type="submit" class="btn btn-primary ml-1" value="OK">
        </form>
    </div>
</div>
<script type="text/javascript" src="js/app.js"></script>
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