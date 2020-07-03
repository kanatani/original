<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/st.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<title>プロフィール確認</title>
</head>
<body>
<?php
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
    $sql = 'SELECT picture FROM sub WHERE id = 0';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $rec) {
    echo $rec['picture'];
    }
}


function select4() {
    global $i;
    $dbh = connect();
    $sql = 'SELECT picture FROM sub WHERE id = :pic_id';
    $stmt = $dbh->prepare($sql);
    $stmt->BindValue(':pic_id',$i);
    $stmt->execute();
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $recs) {
    echo $recs['picture'];
}
}



?>
    <div class="container">
        <div id="gallery">
            <div class = "main">
            <img src="<?php select1() ?>" alt="">
            </div>
            <div class = "thumb">
            <?php 
            for($i = 0; $i<=5; $i++){
            ?>
            <img src="<?php select4() ?>" data-toggle="modal" data-target="#exampleModal<?php echo $i ;?>" id="<?php echo $i; ?>">
            <?php
            }
            ?>
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

<a href="hen.php">プロフィール変更</a>
</body>
</html>