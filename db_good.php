<?php

function select($com_id,$hobby){
    $dsn = 'mysql:dbname=LAA1138637-db;host=mysql136.phy.lolipop.lan';
    $user = 'LAA1138637';
    $password = 'Naokiokane';
    $dbh = new PDO($dsn,$user,$password);
    $dbh->query('SET NAMES utf8');

    $sql = 'SELECT * FROM life_style WHERE com_id = :com_id AND hobby_card = :hobby_card';
    $stmt = $dbh->prepare($sql);
    $stmt->BindValue(':com_id',$com_id);
    $stmt->BindValue(':hobby_card',$hobby);
    $stmt->execute();

    $list = array();
   

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $list[]=array(
            'like_count' => $row['like_count']
        );
        
    }
    $all_list = implode(',', $list[0]);

    echo $all_list;
}


    $user_id = $_POST['simei'];
    $card = $_POST['card'];

    $dsn = 'mysql:dbname=LAA1138637-db;host=mysql136.phy.lolipop.lan';
    $user = 'LAA1138637';
    $password = 'Naokiokane';
    $dbh = new PDO($dsn,$user,$password);
    $dbh->query('SET NAMES utf8');
    
    $sql = 'SELECT * FROM life_style WHERE com_id = :com_id AND hobby_card = :hobby_card';
    $stmt = $dbh->prepare($sql);
    $stmt->BindValue(':com_id',$user_id);
    $stmt->BindValue(':hobby_card',$card);
    $stmt->execute();
    $list = array();

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);

    if(empty($rec)) {
        
        $sql = 'INSERT INTO `life_style`(`hobby_card`, `picture`, `com_id`, `category`, `types`,`like_count`) SELECT hobby_card, picture, :com_id, category, types, :like_count FROM life_style WHERE hobby_card = :hobby_card';
        $stmt = $dbh->prepare($sql);
        $stmt->BindValue(':com_id',$user_id);
        $stmt->BindValue(':like_count',1);
        $stmt->BindValue(':hobby_card',$card);
        $stmt->execute();
        select($user_id,$card);
        
    
    }

    else {
        $sql = 'DELETE FROM life_style WHERE com_id = :com_id AND hobby_card = :hobby_card ';
        $stmt = $dbh->prepare($sql);
        $stmt->BindValue(':com_id',$user_id);
        $stmt->BindValue(':hobby_card',$card);
        $stmt->execute();
        select($user_id,$card);
    }

?>
