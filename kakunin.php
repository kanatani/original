<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<title>お問い合わせ</title>
</head>
<body>
<?php
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
<script type="text/javascript" src="js/app.js"></script>
<script src="js/bubbly-bg.js"></script>
<script>bubbly();</script>
</body>
</html>