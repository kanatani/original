
<?php
    $com_id = $_POST['com_id'];
    $user_id = $_POST['user_id'];

    $dsn = 'mysql:dbname=original;host=localhost';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn,$user,$password);
    $dbh->query('SET NAMES utf8');
    
    $sql = 'SELECT * FROM good WHERE user_id = :user_id AND com_id = :com_id';
        $stmt = $dbh->prepare($sql);
        $stmt->BindValue(':user_id',$user_id);
        $stmt->BindValue(':com_id',$com_id);
        $stmt->execute();
        $rec = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(!empty($rec)) {
            $sql = 'DELETE FROM good WHERE user_id = :user_id AND com_id = :com_id';
            $stmt = $dbh->prepare($sql);
            $stmt->BindValue(':user_id',$user_id);
            $stmt->BindValue(':com_id',$com_id);
            $stmt->execute();
        }
        else {
            $sql = 'INSERT INTO good (user_id,com_id) VALUES ( :user_id, :com_id)';
            $stmt = $dbh->prepare($sql);
            $stmt->BindValue(':user_id',$user_id);
            $stmt->BindValue(':com_id',$com_id);
            $stmt->execute();
        }
?>