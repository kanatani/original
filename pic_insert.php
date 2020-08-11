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

function insert() {
    $category=$_POST['category'];
    $card=$_POST['card'];
    $types=$_POST['types'];

    $card=htmlspecialchars($card);

    $dbh = connect();
    $sql = 'SELECT * FROM life_style WHERE hobby_card = :hobby_card';
    $stmt = $dbh->prepare($sql);
    $stmt->BindValue(':hobby_card',$card);
    $stmt->execute();
    $rec = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(empty($rec))
        {
            if(isset($_FILES) && isset($_FILES['upload']) && is_uploaded_file($_FILES['upload']['tmp_name'])) {
                if(!file_exists('hobby')){
                    mkdir('hobby');
                }
                $a = 'hobby/' . basename($_FILES['upload']['name']);
                    if(move_uploaded_file($_FILES['upload']['tmp_name'],$a)) {
                        $dbh = connect();
                        $sql = 'INSERT INTO life_style (hobby_card,picture,com_id,category,types) VALUES ("'.$card.'","'.$a.'","'.$_SESSION['id'].'","'.$category.'","'.$types.'")';
                        $stmt = $dbh->prepare($sql);
                        $stmt->execute();
                        $dbh = null;
                        header('Location: http://localhost/original/subject/like.php');
                    }
                else 
                {
                    echo '失敗';
                }
        }
    }
    else {
        echo '';
    }
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
<title>カード一覧</title>
</head>
<body>
<div class="container">
    <div　>
        <form action="pic_insert.php" method="post" enctype="multipart/form-data">
            <input type="file" name="upload">
            <select name="category" id="cate">
                <option value="in">インドア</option>
                <option value="out">アウトドア</option>
            </select>
            <select name="types" id="type">
                <option value="like">like</option>
                <option value="bad">bad</option>
            </select>
            <input type="text" name="card" required>
            <input type="submit" name = "send" value="送信">
        </form>
    </div>
<?php
if(isset($_POST["send"])) {
    insert();
}
?>
</div>
<script type="text/javascript" src="js/app.js"></script>
<script src="js/bubbly-bg.js"></script>
<script>bubbly();</script>
</body>
</html>