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
<?php
try 
{
$simei=$_POST['simei'];
$gmail=$_POST['gmail'];
$content=$_POST['content'];


$simei= htmlspecialchars($simei);
$gamil= htmlspecialchars($gmail);
$content= htmlspecialchars($content);

if (empty($content)) {
    echo 'お問い合わせ内容が入力されていません。<br/>';
    print'<form>';
    print'<input type="button" onclick="history.back()" id="modoru" value="戻る">';
    print'</form>';
}
else {
?>
<div id = "inquire">
    <h3>下記の内容でお間違い無いですか?</h3>
    <div class="card text-center mt-3">
        <div class="card-body">
            <p class="card-text">氏名:<?php echo $simei;?>様</p>
        </div>

        <div class="card-body">
            <p class="card-text">メールアドレス:<?php echo $gmail;?></p>
        </div>

        <div class="card-body">
            <p class="card-text">内容:<?php echo $content;?></p>
        </div>
    </div>
    <br>
    <form id="ok" method="post" action="ok.php">
        <input name="simei" type="hidden" value = "<?php echo $simei;?>" >
        <input name="gmail" type="hidden" value = "<?php echo $gmail;?>" >
        <input name="content" type="hidden" value = "<?php echo $content;?>" >
        <button type="button" onclick="history.back()" class="btn btn-primary btn-lg">戻る</button>
        <button type="submit" class="btn btn-secondary btn-lg">送信</button>
    </form>
</div>
<?php
}
?>
<?php
}
catch(PDOException $e) {
    print'<h2 class="error">接続されていません</h2>';
}
?>
<script src="js/app.js"></script>
<script src="js/bubbly-bg.js"></script>
<script>bubbly();</script>
</body>
</html>