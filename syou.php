<?php

session_start();

if(isset($_POST["her_id"])) {
    $_SESSION['com_id'] = $_POST["her_id"];
}

function connect() {
    $dsn = 'mysql:dbname=LAA1138637-db;host=mysql136.phy.lolipop.lan';
    $user = 'LAA1138637';
    $password = 'Naokiokane';
    $dbh = new PDO($dsn,$user,$password);
    $dbh->query('SET NAMES utf8');
    return $dbh;
}

function like_card(){
    $dbh = connect();
    $sql = 'SELECT * FROM life_style WHERE com_id = :com_id AND types = "like"';
    $stmt = $dbh->prepare($sql);
    $stmt->BindValue('com_id',$_SESSION['com_id']);
    $stmt->execute();
    while(1){
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if($rec == false) {
        break;
        }
        ?>
            <li class="scroll_list">
                <a href=""><img src="<?php echo $rec['picture']; ?>" alt=""></a>
                <div><?php echo $rec['hobby_card']; ?></div>
            </li>
        <?php
    }
}

function bad_card(){
    $dbh = connect();
    $sql = 'SELECT * FROM life_style WHERE com_id = :com_id AND types = "bad"';
    $stmt = $dbh->prepare($sql);
    $stmt->BindValue('com_id',$_SESSION['com_id']);
    $stmt->execute();
    while(1){
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if($rec == false) {
        break;
        }
        ?>
            <li class="scroll_list">
                <a href=""><img src="<?php echo $rec['picture']; ?>" alt=""></a>
                <div><?php echo $rec['hobby_card']; ?></div>
            </li>
        <?php
    }
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
<link href='https://fonts.googleapis.com/css?family=Patrick+Hand+SC' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.5.0/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="css/icons.css" />
<link rel="stylesheet" href="css/st.css">
<link rel="shortcut icon" href="favicon.ico">
<link href="https://fonts.googleapis.com/css2?family=Mukta&display=swap" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<title>プロフィール確認</title>

</head>
<body>
    <?php
    try
    {
    ?>
    <header>
        <nav id="global_navi" class = "nav">
                <ul>
                    <li class="current">
                        <a href="look.php">
                            <i class="fas fa-search"></i>
                                探す
                        </a>
                    </li>
                    <li>
                        <a href="good.php">
                            <i class="fas fa-thumbs-up"></i>
                                いいね 
                        </a>
                    </li>
                    <li>
                        <a href="like.php">
                            <i class="far fa-kiss-wink-heart"></i>
                                趣味
                        </a>
                    </li>
                    <li>
                        <a href="chat.php">
                            <i class="fas fa-comments"></i>
                                チャット
                        </a>
                        </li>
                    <li >
                        <a href="pro.php">
                            <i class="fas fa-user-alt"></i>
                                プロフィール
                        </a>
                    </li>
                    <li><a href="#">その他</a>
                    <ul id="ot">
                        <li id="other">
                            <a href="toi.php">
                                <i class="fas fa-question-circle"></i>
                                    お問い合わせ
                            </a>
                        </li>
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
    </header>
    <div class="container nav">
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
                <h3 class="com_like_card">お好みカード</h3>
                <div>like</div>
                <div class="scroll">
                    <ul class="scroll_card">
                        <?php like_card() ?>
                    </ul>
                </div>

                <div>bad</div>
                <div class="scroll">
                    <ul class="scroll_card">
                        <?php bad_card() ?>
                    </ul>
                </div>
            </div>
            
            <div>
                    <input type="hidden" name="compassion_id" id="com" value="<?php echo $_SESSION['com_id']; ?>" >
                    <input type="hidden" name="user_id" id="user" value="<?php echo $_SESSION['id']; ?>" >
                    <input type="hidden" name="scroll_top"  class="st">
                    <section class="content">
                        <ol style = "list-style-type:none;" class="grid">
                            <li class="grid__item">
                                <button type="submit" name="send" id="se" class="icobutton icobutton--thumbs-up"><span class="fa fa-thumbs-up"></span></button>
                            </li>	
                        </ol>
                    </section>
            </div>
        </div>
　　</div>

                

<div id="result">
<p></p>
</div>
<script language="javascript" type="text/javascript">

$(function(){

$('#se').on('click',function(){

 $.ajax({
  url:'http://original-nao.jp/dbname.php', //送信先
  type:'POST', //送信方法
  data:{
   'com_id' : $('input:hidden[name="compassion_id"]').val(),
   'user_id' : $('input:hidden[name="user_id"]').val()
  }
  })
  // Ajax通信が成功した時
  .done( function(data) {
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
}); //#ajax click end

}); //END

let mainFlame = document.querySelector('#gallery .main');

let thumbFlame = document.querySelector('#gallery .thumb');

let mainImage = document.querySelector('.main img');

thumbFlame.addEventListener('click', function(event){
    if (event.target.src) {
        mainImage.src = event.target.src;
    }
});

$('form').submit(function(){
  var scroll_top = $(window).scrollTop();  //送信時の位置情報を取得
  $('input.st',this).prop('value',scroll_top);  //隠しフィールドに位置情報を設定
});
 
window.onload = function(){
  //ロード時に隠しフィールドから取得した値で位置をスクロール
  $(window).scrollTop(<?php echo @$_REQUEST['scroll_top']; ?>);
}



</script>


<script src="http://cdn.jsdelivr.net/mojs/latest/mo.min.js"></script>

<script type="text/javascript" src="js/app.js"></script>
<?php
}
catch(PDOException $e) {
    print'<h2 class="error">接続されていません</h2>';
}
?>
<script src="js/bubbly-bg.js"></script>
<script>bubbly();</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

</body>
</html>





