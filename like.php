<?php
session_start();

function connect() {
    $dsn = 'mysql:dbname=original;host=localhost';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn,$user,$password);
    $dbh->query('SET NAMES utf8');
    return $dbh;
}

function look_like() {
    $dbh = connect();
    $sql = 'SELECT distinct picture, hobby_card FROM life_style WHERE types = "like"';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    while(1)
    {       
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if($rec==false)
        {
            break;
        }
        ?>
        <li class="item">
                <a href="sub_detail.php?card=<?php echo $rec['hobby_card']; ?>&pic=<?php echo $rec['picture']; ?>"><img src=<?php echo $rec['picture'];?> alt="hobby_card"></a>
                <div id="hobby_card"><?php echo $rec['hobby_card'];?></div>
        </li>
        <?php
    }
}

function look_bad() {
    $dbh = connect();
    $sql = 'SELECT distinct picture, hobby_card FROM life_style WHERE types = "bad"';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    while(1)
    {       
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if($rec==false)
        {
            break;
        }
        ?>
            <li class="item">
                <a href="sub_detail.php?card=<?php echo $rec['hobby_card']; ?>&pic=<?php echo $rec['picture']; ?>"><img src=<?php echo $rec['picture'];?> alt="hobby_card"></a>
                <div class="hobby_card"><?php echo $rec['hobby_card'];?></div>
            </li>
        <?php
    }
}


function search() {
    if(empty($_POST['search'])) {
        header('Location: http://localhost/original/subject/like.php');
    }
    else 
    {
        $i=0;
        $look=htmlspecialchars($_POST['search']);
        $dbh = connect();
        $sql = 'SELECT distinct hobby_card,picture FROM life_style WHERE hobby_card LIKE "%'.$look.'%"';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        while(1)
        {
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if($rec == false) 
            {
            break;
            }
            ?>
            <li class="search-list">
                <a href="sub_detail.php?card=<?php echo $rec['hobby_card'] ?>&pic=<?php echo $rec['picture']; ?>"><img src=<?php echo $rec['picture'];?> alt="hobby_card" class="search-img"></a>
                <div class=""><?php echo $rec['hobby_card'];?></div>
            </li>
            
            <?php
            $i++;
        }
    }
}

?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
<link rel="stylesheet" href="css/st.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<title>カード一覧</title>
</head>
<body>
<div class="container ">
    <nav id="global_navi" class = "nav">
            <ul>
                <li><a href="look.php">
                    <i class="fas fa-search"></i>
                    search
                    </a>
                </li>
                <li>
                    <a href="good.php">
                    <i class="fas fa-thumbs-up"></i>
                        good 
                    </a>
                </li>
                <li class="current">
                    <a href="like.php">
                    <i class="far fa-kiss-wink-heart"></i>
                        趣味
                    </a>
                </li>
                <li><a href="chat.php">
                <i class="fas fa-comments"></i>
                    チャット
                    </a>
                </li>
                <li ><a href="pro.php">
                <i class="fas fa-user-alt"></i>
                    プロフィール</a>
                </li>
                <li><a href="#">その他</a>
                <ul id="ot">
                    <li id="other">
                        <a href="toi.php">
                        <i class="fas fa-question-circle"></i>
                            お問い合わせ
                        </a></li>
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

    <div>
        <form id="look" action="like.php" method="post">
            <div class="group_search">
                <span><i class="fas fa-search"></i></span>
                <input type="text" id="input" name="search">
                <input type="submit" name="sent" class="btn btn-info" value="検索">
            </div>
        </form>
    </div>
    
    
    <?php
    
    if(isset($_POST['sent'])) {
        ?>
        <div class="car">
            <ul class="search">
                <?php search(); ?>
            </ul>
        </div>
        <?php
    }
    else {
    ?>
     <div class="like">
        <div>like</div>
        <ul class="horizontal-list">
            <?php
            look_like();
            
            ?>
        </ul>
    </div>
    
    <div class="bad">
        <div>bad</div>
        <ul class="horizontal-list">
            <?php
            look_bad();
            ?>
        </ul>
    </div>
    
   <?php
    }
   ?>
   <br>
   <div >
   <a href="pic_insert.php" class="make">自分で作成!</a>
   </div>
   
</div>
<script src="js/app.js"></script>
<script src="js/bubbly-bg.js"></script>
<script>bubbly();</script>
</body>
</html>