<?php
session_start();

if(isset($_POST["her_id"])) {
    $_SESSION['com_id'] = $_POST["her_id"];
}
function connect() {
    $dsn = 'mysql:dbname=original;host=localhost';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn,$user,$password);
    $dbh->query('SET NAMES utf8');
    return $dbh;
}

function select1() {
    
    $dbh = connect();
    $sql = 'SELECT * FROM sub WHERE user_id = :user_id AND pic_id=:pic_id';
    $stmt = $dbh->prepare($sql);
    $stmt->BindValue(':user_id',$_SESSION['com_id']);
    $stmt->BindValue(':pic_id',0);
    $stmt->execute();
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $rec) {
        echo $rec['picture'];
    }
}

function select2() {
    
    global $i;
    $dbh = connect();
    $sql = 'SELECT picture FROM sub WHERE user_id = :user_id AND pic_id=:pic_id';
    $stmt = $dbh->prepare($sql);
    $stmt->BindValue(':user_id',$_SESSION['com_id']);
    $stmt->BindValue(':pic_id',$i);
    $stmt->execute();
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $recs) {
    echo $recs['picture'];
    $mylist = $recs['picture'];
    }
}


function intro() {
    
    $dbh = connect();
    $sql = 'SELECT * FROM human WHERE user_id = :user_id';
    $stmt = $dbh->prepare($sql);
    $stmt->BindValue(':user_id',$_SESSION['com_id']);
    $stmt->execute();
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $recs) {
        ?>
        <table>
            <tbody>
                <tr>
                    <th>ニックネーム</th>
                    <td><?php echo $recs['simei']; ?></td>
                </tr>
                <tr>
                    <th>出身地</th>
                    <td><?php echo $recs['lived']; ?></td>
                </tr>
                <tr>
                    <th>住居</th>
                    <td><?php echo $recs['live']; ?></td>
                </tr>
                <tr>
                    <th>年齢</th>
                    <td><?php echo $recs['age']; ?></td>
                </tr>
                <tr>
                    <th>学歴</th>
                    <td><?php echo $recs['learn']; ?></td>
                </tr>
                <tr>
                    <th>仕事</th>
                    <td><?php echo $recs['job']; ?></td>
                </tr>
            </tbody>
        </table>
    <?php
    }
}


function good() {

    if(isset($_POST['compassion_id'])) {
        $com_id = $_POST['compassion_id'];
        $dbh = connect();
        $sql = 'SELECT * FROM good WHERE user_id = :user_id AND com_id = :com_id';
        $stmt = $dbh->prepare($sql);
        $stmt->BindValue(':user_id',$_SESSION['id']);
        $stmt->BindValue(':com_id',$com_id);
        $stmt->execute();
        $rec = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(!empty($rec)) {
            $sql = 'DELETE  FROM good WHERE user_id = :user_id AND com_id = :com_id';
            $stmt = $dbh->prepare($sql);
            $stmt->BindValue(':user_id',$_SESSION['id']);
            $stmt->BindValue(':com_id',$com_id);
            $stmt->execute();
        }
        else {
            $sql = 'INSERT INTO good (user_id,com_id) VALUES ( :user_id, :com_id)';
            $stmt = $dbh->prepare($sql);
            $stmt->BindValue(':user_id',$_SESSION['id']);
            $stmt->BindValue(':com_id',$com_id);
            $stmt->execute();
        }
    }
}
if(isset($_POST["send"])) {
    good();
}
?>


<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/st.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<title>プロフィール確認</title>
</head>
<body>


    <div class="container">
        <nav id="global_navi">
            <ul>
                <li class="current"><a href="look.php">search</a></li>
                <li><a href="good.php">good</a></li>
                <li><a href="like.php">趣味</a></li>
                <li><a href="chat.php">チャット</a></li>
                <li><a href="pro.php">プロフィール</a></li>
            </ul>
        </nav>
        <div id="gallery">
            <div class = "main">
                <img class="main_img" src="<?php select1() ?>" alt="">
            </div>
            <div class = "thumb">
                <?php 
                    for($i = 0; $i<=5; $i++){
                ?>
                    <img src="<?php select2() ?>" data-toggle="modal" data-target="#exampleModal<?php echo $i ;?>" id="<?php echo $i; ?>">
            <?php
                }
            ?>
            </div>
            <div id ="mylist">
                <div class="detail_box">
                        <h3>基本情報</h3>
                        <?php intro() ?>
                </div>
            </div>
            <div>
                <form id="form" action="syou.php" method="post">
                    <input type="hidden" name="compassion_id" value="<?php echo $_SESSION['com_id']; ?>">
                    <input type="submit" name="send" value="いいね">
                </form>
            </div>
        </div>

　　</div>



<script language="javascript" type="text/javascript">

let mainFlame = document.querySelector('#gallery .main');

let thumbFlame = document.querySelector('#gallery .thumb');

let mainImage = document.querySelector('.main img');

thumbFlame.addEventListener('click', function(event){
    if (event.target.src) {
        mainImage.src = event.target.src;
    }
});

</script>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/app.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
</body>
</html>