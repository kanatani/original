<?php
try {
session_start();

$onamae=$_POST['onamae'];
$lived=$_POST['lived'];
$live=$_POST['live'];
$age=$_POST['age'];
$learn=$_POST['learn'];
$job=$_POST['job'];
$intro=$_POST['intro'];

$onamae=htmlspecialchars($onamae);
$live=htmlspecialchars($live);
$lived=htmlspecialchars($lived);
$age=htmlspecialchars($age);
$learn=htmlspecialchars($learn);
$job=htmlspecialchars($job);
$intro=htmlspecialchars($intro); 

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<title>自己紹介</title>
</head>
<body>
<div class="container">
    <div class="your_list">
        <?php
        
            echo '<div>名前:'.$onamae.'</div></br>';
            if($lived == '') {
                echo '出身地を選択してください</br>';
            }
            else {
            echo '<div>出身:'.$lived.'</div></br>';
            }

            if($live == '') {
                echo '住所を選択してください</br>';
            }
            else {
            echo '<div>住所:'.$live.'</div></br>';
            }

            if($age == '') {
                echo '年齢を選択してください</br>';
            }
            else {
                echo '<div>年齢:'.$age.'</div></br>';
            }

            if($learn == '') {
                echo '学歴を選択してください</br>';
            }
            else {
                echo '<div>学歴:'.$learn.'</div></br>';
            }

            if($job == '') {
                echo '職業を選択してください</br>';
            }
            else {
                echo '<div>職業:'.$job.'</div></br>';
            }
            
            echo '<div>自己紹介:'.$intro.'</div></br>';
            
            if($lived == '' || $live == '' || $age == '' || $learn == '' || $job == '')
            {
                print'<form>';
                print'<input type="button" onclick="history.back()" id="modoru" value="戻る">';
                print'</form>';
            }
            else 
            {
            ?>
                <form id="sub" method="post" action="thanks.php">
                    <input type="hidden" name="onamae" value="<?php echo $onamae; ?>">
                    <input type="hidden" name="lived" value="<?php echo $lived; ?>">
                    <input type="hidden" name="live" value="<?php echo $live; ?>">
                    <input type="hidden" name="age" value="<?php echo $age; ?>">
                    <input type="hidden" name="learn" value="<?php echo $learn; ?>">
                    <input type="hidden" name="job" value="<?php echo $job; ?>">
                    <input type="hidden" name="intro" value="<?php echo $intro; ?>">
                    <input type="button" onclick="history.back()" id="modoru" value="戻る">
                    <input type="submit" value="送信">
                </form>
            <?php
            }
        ?>
    </div>
    <?php 
} 
catch (expection $e) 
{
    echo 'エラーです';
}
?>
</div>
</body>
</html>

