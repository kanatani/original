<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/style.css">
<link rel="shortcut icon" href="favicon.ico">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<title>アップロード</title>
</head>
<body>
<?php
try{
?>
    <div class="container">
    <?php
    if (!empty($_FILES['file'] ['tmp_name'])){
        if(is_uploaded_file($_FILES['file'] ['tmp_name'])) {
            if (! file_exists('upload')) {
                mkdir ('upload');
            }
            $file = 'upload/' . basename($_FILES['file']['name']);
            if (move_uploaded_file($_FILES['file']['tmp_name'], $file)) {
                $msg = 'アップロードに成功しました';
                echo '<p><img src="',$file,'"></p>';
            } else {
                $msg = 'アップロードに失敗しました';
            }
        } else {
            echo '問題';
            var_dump($_FILES['file'] ['tmp_name']);
        }
        if (isset($msg) && $msg == true) {
        echo '<p>'. $msg . '</p>';
        }
    } 
    ?>
        <h4>アップロード機能</h4>
        <form action="upload-input.php" method="post" enctype="multipart/form-data">
            <input type="file" name="file">
            <input type="submit" value="読み込み">
        </form>
　　</div>
<?php
}
catch(PDOException $e) {
    print'<h2 class="error">ただいま障がいによりご迷惑をおかけしております。</h2>';
}
?>
<script src="js/bubbly-bg.js"></script>
<script>bubbly();</script>
</body>
</html>