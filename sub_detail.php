<?php
session_start();

if (isset($_GET['card'])) {
$_SESSION['card'] = $_GET['card'];
$_SESSION['pic']= $_GET['pic'];
}

function connect() {
    $dsn = 'mysql:dbname=LAA1138637-db;host=mysql136.phy.lolipop.lan';
    $user = 'LAA1138637';
    $password = 'Naokiokane';
    $dbh = new PDO($dsn,$user,$password);
    $dbh->query('SET NAMES utf8');
    return $dbh;
}

function button() {
    $dbh = connect();
    $sql = 'SELECT like_count FROM life_style WHERE hobby_card = :hobby_card AND com_id = :com_id limit 1';
    $stmt = $dbh->prepare($sql);
    $stmt->BindValue(':hobby_card',$_SESSION['card']);
    $stmt->BindValue(':com_id',$_SESSION['id']);
    $stmt->execute();

    while(1) {
        $recs = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if(empty($recs['like_count'])) 
    { 
        ?>
        <button type="button" name="send" id ="good_card" class="btn btn-outline-info love">いいね!</button>
        <?php 
        break;
    } 
    else 
    {
        ?>
        <button type="button" name="send" id ="good_card" class="btn btn-outline-info love active">解除!</button>
        <?php
        break;
    }
    }
}

function select() {
    $dbh = connect();
    $sql = 'SELECT DISTINCT * FROM life_style WHERE hobby_card = :hobby_card AND picture = :picture limit 1';
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
             
                <input type="hidden" name="simei" value="<?php echo $_SESSION['id'] ?>">
                <input type="hidden" name="card" value="<?php echo $_SESSION['card'] ?>">
                <input type="hidden" name="category" value="<?php echo $rec['category'] ?>">
                <input type="hidden" name="type" value="<?php echo $rec['types'] ?>">
                <?php button(); ?>
             
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
        <div class="list">
        <div class="list_img">
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
try
{
?>

<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/st.css">
<link rel="shortcut icon" href="favicon.ico">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<title>アップロード</title>
<style>
    #good_card.active{
        background-color: #59dada;
        color: #fff;
    }

</style>
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

<script>
    $(function(){
        
    $('#good_card').on('click',function(){


    $.ajax({
    url:'http://original-nao.jp/db_good.php', //送信先
    type:'POST', //送信方法
    data:{
    'card' : $('input:hidden[name="card"]').val(),
    'category' : $('input:hidden[name="category"]').val(),
    'types' : $('input:hidden[name="types"]').val(),
    'simei' : $('input:hidden[name="simei"]').val()
    }
    })
    // Ajax通信が成功した時
    .done( function(data) {
        if(data == 1){
            $('#good_card').text('解除!');
            $('#good_card').addClass('active');
        }
        else
        {
            $('#good_card').text('いいね!');
            $('#good_card').removeClass('active');
        }
    
    console.log(data[0]);
    console.log('通信成功');
    console.log(data);
    })
    // Ajax通信が失敗した時
    .fail( function(jqXHR, textStatus, errorThrown) {
        console.log('通信失敗');
        console.log(jqXHR);
        console.log(textStatus);
        console.log(errorThrown);
    })
    });

}); //END

</script>
<?php
}
catch(PDOException $e) {
    print'<h2 class="error">接続されていません</h2>';
}
?>
<script src="js/bubbly-bg.js"></script>
<script>bubbly();</script>
</body>
</html>