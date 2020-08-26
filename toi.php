<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/style.css">
<link rel="shortcut icon" href="favicon.ico">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<title>お問い合わせ</title>
</head>
<body>
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
<script type="text/javascript" src="js/app.js"></script>
<script src="js/bubbly-bg.js"></script>
<script>bubbly();</script>
</body>
</html>