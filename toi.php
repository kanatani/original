<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/style.css">
<link rel="shortcut icon" href="favicon.ico">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<title>お問い合わせ</title>
</head>
<body>
<?php
try{
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
                    <li >
                        <a href="pro.php">
                            <i class="fas fa-user-alt"></i>
                                プロフィール
                        </a>
                    </li>
                    <li><a href="#">その他</a>
                    <ul id="ot">
                        <li id="other" class="current">
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
    <div id="inquire">
        <h2>お問い合わせ</h2>
        <form id="entry" method="post" action="kakunin.php">
            <dl>
                <dt>氏名</dt>
                <dd><input type="text" name="simei" class="form-control" id="" required></dd>
                <dt>メールアドレス</dt>
                <dd><input type="email" name="gmail" class="form-control" id="" required></dd>
                <dt>お問い合わせ内容</dt>
                <dd><textarea name="content" class="form-control" id="" cols="10" rows="5"></textarea></dd>
            </dl>
            <input name="send" id="send" class="btn btn-outline-primary" type="submit" value="送信">
        </form>
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