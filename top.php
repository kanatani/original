<?php
try{
function connect() {
    $dsn = 'mysql:dbname=LAA1138637-db;host=mysql136.phy.lolipop.lan';
    $user = 'LAA1138637';
    $password = 'Naokiokane';
    $dbh = new PDO($dsn,$user,$password);
    $dbh->query('SET NAMES utf8');
    return $dbh;
}

function img() {
    $dsn = 'mysql:dbname=LAA1138637-db;host=mysql136.phy.lolipop.lan';
    $user = 'LAA1138637';
    $password = 'Naokiokane';
    $dbh = new PDO($dsn,$user,$password);
    $dbh->query('SET NAMES utf8');
    $sql = 'SELECT * FROM sub WHERE user_id = :user_id AND pic_id = :pic_id';
    $stmt = $dbh->prepare($sql);
    $stmt->BindValue(':user_id',$_SESSION['id']);
    $stmt->BindValue(':pic_id',0);
    $stmt->execute();

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!empty($rec)){
        $_SESSION['picture'] = $rec['picture'];
    }
   
}


function login(){
    $netpass = filter_input(INPUT_POST, 'netpass');
    $gmail = filter_input(INPUT_POST, 'gmail', FILTER_VALIDATE_EMAIL);
    $dbh = connect();
    $sql = 'SELECT * FROM loguin WHERE gmail = :gmail AND netpass = :netpass';
    $stmt = $dbh->prepare($sql);
    $stmt->BindValue(':gmail',$gmail);
    $stmt->BindValue(':netpass',$netpass);
    $stmt->execute();

    $member = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!isset($member['netpass'])) {
        echo '新規登録をお願いします。';
        header('Location: http://original-nao.jp/sinki.html');
    }
    else 
    {
        session_start();
        session_regenerate_id(true);
        $_SESSION['id'] = $member['id'];
        $_SESSION['user_name'] = $member['user_name'];
        if(empty($member['enter'])) {
            $dbh = connect();
            $sql = 'UPDATE loguin set enter = "good" WHERE id=:user_id';
            $stmt = $dbh->prepare($sql);
            $stmt->BindValue(':user_id',$_SESSION['id']);
            $stmt->execute();
            header('Location: http://original-nao.jp/intro.php');
        }
        else
        {
        img();
        header('Location: http://original-nao.jp/look.php');
        }
    }
}
?>
<?php
    if (isset($_POST["send"])) {
        login();
    }
    else{
?>

<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="https://fonts.googleapis.com/css2?family=Raleway+Dots&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=M+PLUS+1p:wght@100&family=Mukta&family=Raleway&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/st.css">
<link rel="shortcut icon" href="icon.ico">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style>
    
</style>
<title>トップページ</title>
</head>
<body>
<div class="container top_page">
  <!-- Content here -->
    <h1 class="loguin_font">login form</h1>
    </br>
    <div class="login">
        <form id = "mit" method = "post" action="top.php"> 
            <div class="form-group mail">
                <label for="exampleInputEmail1" class="smallfont">Email address</label>
                <input name="gmail" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>

            <div class="form-group pass">
                <label for="exampleInputPassword1" class="smallfont">Password</label>
                <input name="netpass" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
            </div>
            <button  name="send" type="submit" class="btn btn-primary btn-lg btn-block">login</button>
        </form>

        <div class="sinki">
            新規登録がまだの方はこちらにアクセスしてください。
            </br>
            <div class="alert alert-info" role="alert">
                <a href="sinki.html" class="alert-link">新規登録</a>
            </div>
        </div>

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
<?php
    }
}
catch(PDOException $e) {
    print'接続されていません';
}
?>
