<?php
function connect() {
    $dsn = 'mysql:dbname=LAA1138637-db;host=mysql136.phy.lolipop.lan';
    $user = 'LAA1138637';
    $password = 'Naokiokane';

    $dbh = new PDO($dsn,$user,$password);
    $dbh->query('SET NAMES utf8');
    return $dbh;
}

function id_form($mail){
    
    $dbh = connect();
    $dbh->query('SET NAMES utf8');
    $sql = 'SELECT * FROM loguin WHERE gmail = :mail';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':mail', $mail);
    $stmt->execute();   
    $recs = $stmt->fetch(PDO::FETCH_ASSOC);

    $_SESSION['id'] = $recs['id'];
    $_SESSION['user_name'] = $recs['user_name'];
}

function newlog() {
    $user_name = filter_input(INPUT_POST, 'user_name');
    $gmail = filter_input(INPUT_POST, 'gmail', FILTER_VALIDATE_EMAIL);
    $netpass = filter_input(INPUT_POST, 'netpass');
    
    $user_name = htmlspecialchars($user_name);
    $gmail = htmlspecialchars($gmail);
    $netpass = htmlspecialchars($netpass);
    $dbh = connect();
    $dbh->query('SET NAMES utf8');
    
    $sql = 'SELECT * FROM loguin WHERE gmail = :gmail';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':gmail', $gmail);
    $stmt->execute();   
    
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if(!isset($rec['gmail'])) {
        session_start();
        $sql = 'INSERT INTO loguin (user_name,gmail,netpass,enter) VALUES (:user_name, :gmail, :netpass, :good)';
        $stmt = $dbh->prepare($sql);
        $stmt->BindValue(':user_name',$user_name);
        $stmt->BindValue(':gmail',$gmail);
        $stmt->BindValue(':netpass',$netpass);
        $stmt->BindValue(':good','good');
        $stmt->execute();
        id_form($gmail);
        header('Location: http://original-nao.jp/intro.php');
    } 
    else 
    {
        header('Location: http://original-nao.jp/iyo.php');
    }
    $dbh =null;
}

if(isset($_POST["send"])) {
    newlog();
}

?>

<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/st.css">
<link rel="shortcut icon" href="favicon.ico">
<link href="https://fonts.googleapis.com/css2?family=M+PLUS+1p:wght@100&family=Mukta&family=Raleway&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style>
.new_option{
    font-family: 'M PLUS 1p', sans-serif;
    letter-spacing: 3px;
}
</style>
<title>新規登録</title>
</head>
<body>
<div id="outer">
    <div class="container" id="new">
        <!-- Content here -->
        <div></div>
    <h1 class="new_option">new registration</h1>
    </br>
    新規登録をお願いします
    <form method = "post" action="sinki.php" id="new_user">
        <div class="form-group">
            <label class="naimu smallfont" for="exampleInputEmail1" >username</label>
            <input name="user_name" type="text" class="form-control " id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="name" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1" class="smallfont">Email address</label>
            <input name="gmail" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
        </div>
        <div class="form-group">
            <label class="pass smallfont" for="exampleInputPassword1" >Password</label>
            <input name="netpass" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
        </div>
        </br>
        <input class="btn btn btn-primary" name="send" type="submit" value="新規登録">
    </form>
    <div class="return">
        <div class="alert alert-primary" role="alert">
            <a href="index.php" class="alert-link">トップページ</a>
        </div>
    </div>
　　</div>
</div>
<script src="js/bubbly-bg.js"></script>
<script>bubbly();</script>
</body>
</html>