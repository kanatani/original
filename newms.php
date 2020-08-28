<?php   
session_start();


    if (isset($_GET['room'])) {
        $_SESSION['room']= $_GET['room'];
        $_SESSION['simei']= $_GET['simei'];
    }

    function connectDB() {
        $dsn = 'mysql:dbname=LAA1138637-db;host=mysql136.phy.lolipop.lan';
        $user = 'LAA1138637';
        $password = 'Naokiokane';
        $dbh = new PDO($dsn,$user,$password);
        $dbh->query('SET NAMES utf8');
        return $dbh;
    }

    function img($com_id) {
        $dbh = connectDB();
        $sql = 'SELECT * FROM sub WHERE user_id = :user_id and pic_id=0';
        $stmt = $dbh->prepare($sql);
        $stmt->BindValue(':user_id',$com_id);
        $stmt->execute(); 
        
        foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $img) {
            echo $img['picture'];
        }
    }

    function com_name($com_id) {
        $dbh = connectDB();
        $sql = 'SELECT distinct simei FROM human WHERE user_id = :user_id';
        $stmt = $dbh->prepare($sql);
        $stmt->BindValue(':user_id',$com_id);
        $stmt->execute(); 
        
        foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $name) {
            echo $name['simei'];
        }
    }

    function in() {
        $room_id = $_POST['rooom'];
        $mean = $_POST['mean'];
        $dbh = connectDB();
        $sql = 'INSERT INTO chat(room_id,user_id,mean,hour) VALUES (:room_id,:user_id,:mean, now())';
        $stmt = $dbh->prepare($sql);
        $stmt->BindValue(':room_id',$room_id);
        $stmt->BindValue(':user_id',$_SESSION['id']);
        $stmt->BindValue(':mean',$mean);
        $stmt->execute();
        header('Location: http://original-nao.jp/newms.php');
        $dbh=null;
    }

    function select_new() {
        $dbh = connectDB();
        $sql = 'SELECT * FROM chat WHERE room_id = :room_id AND mean IS NOT NULL ORDER BY hour';
        $stmt = $dbh->prepare($sql);
        $stmt->BindValue(':room_id',$_SESSION['room']);
        $stmt->execute();
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $message) {
                if($message['user_id'] == $_SESSION['id']) {
            ?>
                <li class="bms right-side"> 
                    <div class="pic">
                    <img src="<?php echo $_SESSION['picture']; ?>" alt="">
                    <br>
                    <div><?php echo $_SESSION['user_name']; ?></div>
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
                    else {
                        ?>
                            <li class="bms left-side"> 
                                <div class="pic">
                                <img src="<?php img($message['user_id']); ?>" alt="">
                                <br>
                                <div><?php com_name($message['user_id']); ?></div>
                                </div>
                                <div class="text">
                                <?php  
                                echo $message['mean'],": ",$message['hour'];
                                echo '<br>'; 
                                ?>
                                </div>  
                            </li>
                        <?php
                        $dbh = null;
                        }
                    }
                }
?>

<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> 
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="css/st.css">
<link rel="shortcut icon" href="favicon.ico">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<title>チャット</title>
</head>
<body>
<?php
    try{
?>
<div class="container">
    <div>
        <a href="chat.php">
        <i id= "return" class="fa fa-angle-left"></i>
        </a>
    </div>

    <div class="con">
        <ul class="message">
            <?php
                if (isset($_POST["send"])) {
                    in();
                }
            ?>
            <?php select_new(); ?>
        </ul>
        
        <div id = "sub">
            <form id = "form" method = "post" action="newms.php"> 
                <textarea  name="mean" id="sent_message" cols="30" rows="2"></textarea>
                <input type="hidden" name="rooom" value=<?php echo $_SESSION['room'] ;?>>
                <input type="hidden" name="scroll_top" value="" class="st">
                <input name = "send" id="sent_btn" type="submit" value="送信">
            </form> 
        </div>
    </div>
</div>

<script language="javascript" type="text/javascript">

$('form').submit(function(){
  var scroll_top = $(window).scrollTop();  //送信時の位置情報を取得
  $('input.st',this).prop('value',scroll_top);  //隠しフィールドに位置情報を設定
});
 
window.onload = function(){
  //ロード時に隠しフィールドから取得した値で位置をスクロール
  $(window).scrollTop(<?php echo @$_REQUEST['scroll_top']; ?>);
}
</script>
<?php
}
catch(PDOException $e) {
    print'<h2 class="error">接続されていません</h2>';
}
?>
<script type="text/javascript" src="js/app.js"></script>
<script src="js/bubbly-bg.js"></script>
<script>bubbly();</script>
</body>
</html>