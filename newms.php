<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="css/style.css">
<title>チャット</title>
</head>
<body>
<div class="container">
<?php   
session_start();
session_regenerate_id(true);
try {
    
if (isset($_POST["send"])) {
    insert();
}

} 
catch(PDOException $e) {
    print'接続されていません';
}

function connectDB() {
    $dsn = 'mysql:dbname=original;host=localhost';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn,$user,$password);
    $dbh->query('SET NAMES utf8');
    return $dbh;
}

function select_new() {
    $dbh = connectDB();
    $sql = 'SELECT * FROM chat ORDER BY hour';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $message) {
        ?>
            <li class="bms left-side"> 
                <div class="pic">
                <img src="<?php echo $_SESSION['picture']; ?>" alt="">
                <br>
                <div><?php naimu() ?></div>
                </div>
                <div class="text">
                <?php  
                echo $message['mean'],": ",$message['hour'];
                echo '<br>'; 
                ?>
                </div>
            </li>
        <?php
    }
}

function insert() {
    $dbh = connectDB();
    $sql = 'INSERT INTO chat(mean,hour) VALUES (:mean, now())';
    $stmt = $dbh->prepare($sql);
    $params = array(':mean'=>$_POST['mean']);
    $stmt->execute($params);
    header('Location: http://localhost/original/subject/newms.php');
    exit;
}

function select1() {
    $dbh = connectDB();
    $sql = 'SELECT * FROM chat ORDER BY hour DESC limit 1';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $message) {
        echo $message['mean'],":    ",$message['hour'];
        echo '<br>';
    }
}

function select2() {
        $dbh = connectDB();
        $sql = 'SELECT * FROM chat ORDER BY hour DESC limit 1 offset 1';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $message) {
            echo $message['mean'],":    ",$message['hour'];
            echo '<br>';
            
        }
}

function naimu() {
    echo $_SESSION['simei'];
}
?>

    <div class="con">
        <ul class="message">
          <?php select_new() ?>
        </ul>
    <footer>
    <form id = "form" method = "post" action="newms.php"> 
        <textarea  name="mean" id="sent_message" cols="30" rows="2"></textarea>
        <input name = "send" id="sent_btn" type="submit" value="送信">
    </form>
    </footer>
    </div>
</div>
<a href="out.php">ログアウト</a>
<script type="text/javascript" src="js/app.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
</body>
</html>