<?php
session_start();

if (isset($_GET['card'])) {
$_SESSION['card'] = $_GET['card'];
$_SESSION['pic'] = $_GET['pic'];

}
function connect() {
    $dsn = 'mysql:dbname=original;host=localhost';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn,$user,$password);
    $dbh->query('SET NAMES utf8');
    return $dbh;
}

function select() {
    $dbh = connect();
    $sql = 'SELECT distinct picture, hobby_card FROM life_style WHERE hobby_card = :hobby_card AND picture = :picture';
    $stmt = $dbh->prepare($sql);
    $stmt->BindValue(':hobby_card',$_SESSION['card']);
    $stmt->BindValue(':picture',$_SESSION['pic']);
    $stmt->execute();

    while(1)
    {       
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if($rec==false)
        {
            break;
        }
         ?>
         <div class="main_range">
             <div class="main_img"><img src="<?php echo $rec['picture'] ?>" alt="card"></div>
             <div class="main_text"><p>カード名：<?php echo $rec['hobby_card'] ?></p></div>
             <form id = "forms" action="sub_detail.php" method="post">
                <input type="hidden" name="simei" value="<?php echo $_SESSION['id'] ?>">
                <input type="submit" name="send" class="btn btn-info love" value="いいね">
            </form>
         </div>
         <?php
    }
}

function select1() {
    $dbh = connect();
    $sql = 'SELECT * FROM life_style left JOIN sub ON life_style.com_id = sub.user_id left JOIN human ON life_style.com_id = human.user_id WHERE sub.pic_id=0 AND life_style.hobby_card=:hobby_card';
    $stmt = $dbh->prepare($sql);
    $stmt->BindValue(':hobby_card',$_SESSION['card']);
    
    $stmt->execute();

    while(1) {
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if($rec==false) {
        break;
        }
        ?>
        <div class="li">
        <form id="" action="syou.php" method="post">
        <div class="col list">
        <div class="card" style="width: 18rem;">
        <input type="hidden" name="her_id" value="<?php echo $rec['user_id']; ?>">
        <input type="image" class="img" src="<?php echo $rec['picture']; ?>" alt="">
        </form>
        <div class="card-body list-text">
        <p class="card-text"><?php echo $rec['simei'];  echo $rec['age']; ?></p>
        </div>
        </div>
        </div>
        </form>
        </div>
        <?php
    }
}

function good() {
    if(isset($_POST['simei'])) {
        $dbh = connect();
        $sql = 'SELECT * FROM life_style WHERE com_id = :com_id AND hobby_card = :hobby_card';
        $stmt = $dbh->prepare($sql);
        $stmt->BindValue(':com_id',$_SESSION['id']);
        $stmt->BindValue(':hobby_card',$_SESSION['card']);
        $stmt->execute();
        $rec = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(!empty($rec)) {
            $sql = 'DELETE FROM life_style WHERE com_id = :com_id AND hobby_card = :hobby_card ';
            $stmt = $dbh->prepare($sql);
            $stmt->BindValue(':com_id',$_SESSION['id']);
            $stmt->BindValue(':hobby_card',$_SESSION['card']);
            $stmt->execute();
        }

        else {
            $sql = 'INSERT INTO `life_style`(`hobby_card`, `picture`, `com_id`, `category`, `types`) SELECT hobby_card, picture, :com_id, category, types FROM life_style WHERE hobby_card = :hobby_card';
            $stmt = $dbh->prepare($sql);
            $stmt->BindValue(':com_id',$_SESSION['id']);
            $stmt->BindValue(':hobby_card',$_SESSION['card']);
            $stmt->execute();
        }       
    }
}

if(isset($_POST['send'])) {
    good();
}


?>

<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/st.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<title>アップロード</title>
</head>
<body>
<div class="container">
    
    <?php
    select();
    ?>

    <div class="row">
        <?php
        select1();
        ?>
    </div>
    <a href="like.php" class = "back">前に戻る</a>
</div>
<script type="text/javascript" src="js/app.js"></script>
<script src="js/bubbly-bg.js"></script>
<script>bubbly();</script>
</body>
</html>