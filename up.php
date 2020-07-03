<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/st.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<title>プロフィール変更</title>
</head>
<body>
<?php
//関数
session_start();
session_regenerate_id(true);

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

function select3() {
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

function insert1() {
    $file=$_POST['up'];
    $keyid=$_POST['key'];
    $dbh = connect();
    $sql = 'REPLACE INTO sub (id,picture) VALUES (:keyid, :picture)';
    $stmt = $dbh->prepare($sql);
    $stmt->BindValue(':keyid',$keyid);
    $stmt->BindValue(':picture',$file);
    $stmt->execute();
    $stmt = null;
}

function insert2() {
    $file=$_POST['up'];
    $dbh = connect();
    $sql = 'REPLACE INTO loguin (picture) VALUES (:picture)';
    $stmt = $dbh->prepare($sql);
    $stmt->BindValue(':picture',$file);
    $stmt->execute();
    $stmt = null;
}

if(isset($_POST["send"])) {
    insert1();
    if($_POST['key'] == 0) {
        insert2();
    }
}


?>
<!-- プロフィール変更 -->
<div class="container" id="gallery">
<!-- Button trigger modal -->
    <div class="main">
        <img src="<?php select1() ?>" alt="" data-toggle="modal" data-target="#exampleModalCenter1">
    </div>

<!-- Modal -->
    <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">画像を選択してください</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <form method="post" action="up-sub.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="file" name="file0" accept="image/*">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary ml-1"  value="OK">
                </div>
            </form>
            </div>
        </div>
    </div>


    <div class="thumb">
        
    <?php 
    for($i = 1; $i<=5; $i++){
    ?>

        <img src="<?php select3() ?>" data-toggle="modal" data-target="#exampleModal<?php echo $i ;?>" id="<?php echo $i; ?>">
        <?php
        echo '<div class="modal fade" id="exampleModal'.$i.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        ?>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><?php echo "$i"; ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <form method="post" action="up-sub.php" enctype="multipart/form-data">
                    <div class="modal-body">
                        <?php echo'<input type="file" name="file'.$i.'" accept="image/*">'; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary ml-1" name="sousin" value="OK">
                    </div>
                </form>
            </div>
        </div>
</div>
        <?php
    }
    
    ?>
    </div>
</div>
<script type="text/javascript" src="js/app.js"></script>
</body>
</html>
