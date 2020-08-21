<?php
//関数
session_start();

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
    $sql = 'SELECT picture FROM sub WHERE user_id = :user_id AND pic_id=:pic_id';
    $stmt = $dbh->prepare($sql);
    $stmt->BindValue(':user_id',$_SESSION['id']);
    $stmt->BindValue(':pic_id',0);
    $stmt->execute();
    
    while(1){
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if(!empty($rec['picture']))
        {
            ?>
                <img src="<?php echo $rec['picture'] ?>" alt="" data-toggle="modal" data-target="#exampleModalCenter1">
            <?php
            
        break;
        }
        else{
            echo '<i class="fas fa-camera fa-5x" data-toggle="modal" data-target="#exampleModalCenter1"></i>';
            echo '<br>';
            echo '画像を選択してください';
            break;
        }


        }
}

function select3() {
    global $i;
    $dbh = connect();
    $sql = 'SELECT picture FROM sub WHERE user_id = :user_id AND pic_id=:pic_id';
    $stmt = $dbh->prepare($sql);
    $stmt->BindValue(':user_id',$_SESSION['id']);
    $stmt->BindValue(':pic_id',$i);
    $stmt->execute();
    while(1){
        $recs = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if(!empty($recs['picture']))
        {
            ?>
                <img src="<?php echo $recs['picture'] ?>" data-toggle="modal" data-target="#exampleModal<?php echo $i; ?>" id="<?php echo $i; ?>">
            <?php
            
        break;
        }
        else{
            ?>
            <i class="fas fa-camera fa-3x" id = "option_image" data-toggle="modal" data-target="#exampleModal<?php echo $i; ?>" id="<?php echo $i; ?>"><h6>クリック</h6></i>
            <?php
            break;
        }


        }
}

function insert1() {
    $file=$_POST['up'];
    $pic_id=$_POST['key'];
    $dbh = connect();
    $sql = 'REPLACE INTO sub (pic_id,user_id,picture) VALUES (:pic_id,:user_id,:picture)';
    $stmt = $dbh->prepare($sql);
    $stmt->BindValue(':user_id',$_SESSION['id']);
    $stmt->BindValue(':pic_id',$pic_id);
    $stmt->BindValue(':picture',$file);
    $stmt->execute();
    $stmt = null;
    header('Location: http://localhost/original/subject/up.php');
}

function insert2() {
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

    $dbh = connect();
    $sql = 'UPDATE human set simei = :simei, lived = :lived, live = :live, age=:age, learn=:learn, job=:job, intro=:intro WHERE user_id=:user_id';
    $stmt = $dbh->prepare($sql);
    $stmt->BindValue(':simei',$onamae);
    $stmt->BindValue(':lived',$lived);
    $stmt->BindValue(':live',$live);
    $stmt->BindValue(':age',$age);
    $stmt->BindValue(':learn',$learn);
    $stmt->BindValue(':job',$job);
    $stmt->BindValue(':intro',$intro);
    $stmt->BindValue(':user_id',$_SESSION['id']);
    $stmt->execute();
    $stmt = null;
    header('Location: http://localhost/original/subject/up.php');
}

function delete() {
    $pic_id=$_POST['key'];
    $dbh = connect();
    $sql = 'DELETE FROM sub WHERE user_id = :user_id AND pic_id=:pic_id';
    $stmt = $dbh->prepare($sql);
    $stmt->BindValue(':user_id',$_SESSION['id']);
    $stmt->BindValue(':pic_id',$pic_id);
    $stmt->execute();
}

function intro() {
    $dbh = connect();
    $sql = 'SELECT * FROM human WHERE user_id = :user_id';
    $stmt = $dbh->prepare($sql);
    $stmt->BindValue(':user_id',$_SESSION['id']);
    $stmt->execute();
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $recs) {
        ?>
<div class="basic">
    <form id="in" method="post" action="up.php">
        <table>
            <tbody>
                <tr>
                    <th>ニックネーム</th>
                    <td><input type="text" name="onamae" id="onamae" value="<?php echo $recs['simei'] ; ?>"required></td>
                </tr>
                <tr>
                    <th>出身地</th>
                    <td>
                    <select name="lived">
                    <option value="">選択してください</option>
                    <option value="北海道">北海道</option>
                    <option value="青森県">青森県</option>
                    <option value="岩手県">岩手県</option>
                    <option value="宮城県">宮城県</option>
                    <option value="秋田県">秋田県</option>
                    <option value="山形県">山形県</option>
                    <option value="福島県">福島県</option>
                    <option value="茨城県">茨城県</option>
                    <option value="栃木県">栃木県</option>
                    <option value="群馬県">群馬県</option>
                    <option value="埼玉県">埼玉県</option>
                    <option value="千葉県">千葉県</option>
                    <option value="東京都" selected>東京都</option>
                    <option value="神奈川県">神奈川県</option>
                    <option value="新潟県">新潟県</option>
                    <option value="富山県">富山県</option>
                    <option value="石川県">石川県</option>
                    <option value="福井県">福井県</option>
                    <option value="山梨県">山梨県</option>
                    <option value="長野県">長野県</option>
                    <option value="岐阜県">岐阜県</option>
                    <option value="静岡県">静岡県</option>
                    <option value="愛知県">愛知県</option>
                    <option value="三重県">三重県</option>
                    <option value="滋賀県">滋賀県</option>
                    <option value="京都府">京都府</option>
                    <option value="大阪府">大阪府</option>
                    <option value="兵庫県">兵庫県</option>
                    <option value="奈良県">奈良県</option>
                    <option value="和歌山県">和歌山県</option>
                    <option value="鳥取県">鳥取県</option>
                    <option value="島根県">島根県</option>
                    <option value="岡山県">岡山県</option>
                    <option value="広島県">広島県</option>
                    <option value="山口県">山口県</option>
                    <option value="徳島県">徳島県</option>
                    <option value="香川県">香川県</option>
                    <option value="愛媛県">愛媛県</option>
                    <option value="高知県">高知県</option>
                    <option value="福岡県">福岡県</option>
                    <option value="佐賀県">佐賀県</option>
                    <option value="長崎県">長崎県</option>
                    <option value="熊本県">熊本県</option>
                    <option value="大分県">大分県</option>
                    <option value="宮崎県">宮崎県</option>
                    <option value="鹿児島県">鹿児島県</option>
                    <option value="沖縄県">沖縄県</option>
                </select>
                    </td>
                </tr>
                <tr>
                    <th>住居</th>
                    <td>
                    <select name="live">
                    <option value="">選択してください</option>
                    <option value="北海道">北海道</option>
                    <option value="青森県">青森県</option>
                    <option value="岩手県">岩手県</option>
                    <option value="宮城県">宮城県</option>
                    <option value="秋田県">秋田県</option>
                    <option value="山形県">山形県</option>
                    <option value="福島県">福島県</option>
                    <option value="茨城県">茨城県</option>
                    <option value="栃木県">栃木県</option>
                    <option value="群馬県">群馬県</option>
                    <option value="埼玉県">埼玉県</option>
                    <option value="千葉県">千葉県</option>
                    <option value="東京都" selected>東京都</option>
                    <option value="神奈川県">神奈川県</option>
                    <option value="新潟県">新潟県</option>
                    <option value="富山県">富山県</option>
                    <option value="石川県">石川県</option>
                    <option value="福井県">福井県</option>
                    <option value="山梨県">山梨県</option>
                    <option value="長野県">長野県</option>
                    <option value="岐阜県">岐阜県</option>
                    <option value="静岡県">静岡県</option>
                    <option value="愛知県">愛知県</option>
                    <option value="三重県">三重県</option>
                    <option value="滋賀県">滋賀県</option>
                    <option value="京都府">京都府</option>
                    <option value="大阪府">大阪府</option>
                    <option value="兵庫県">兵庫県</option>
                    <option value="奈良県">奈良県</option>
                    <option value="和歌山県">和歌山県</option>
                    <option value="鳥取県">鳥取県</option>
                    <option value="島根県">島根県</option>
                    <option value="岡山県">岡山県</option>
                    <option value="広島県">広島県</option>
                    <option value="山口県">山口県</option>
                    <option value="徳島県">徳島県</option>
                    <option value="香川県">香川県</option>
                    <option value="愛媛県">愛媛県</option>
                    <option value="高知県">高知県</option>
                    <option value="福岡県">福岡県</option>
                    <option value="佐賀県">佐賀県</option>
                    <option value="長崎県">長崎県</option>
                    <option value="熊本県">熊本県</option>
                    <option value="大分県">大分県</option>
                    <option value="宮崎県">宮崎県</option>
                    <option value="鹿児島県">鹿児島県</option>
                    <option value="沖縄県">沖縄県</option>
                </select>
                    </td>
                </tr>
                <tr>
                    <th>年齢</th>
                    <td>
                    <select name="age">
                    <option value="">-</option>
                    <option value="0" selected>0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
                    <option value="32">32</option>
                    <option value="33">33</option>
                    <option value="34">34</option>
                    <option value="35">35</option>
                    <option value="36">36</option>
                    <option value="37">37</option>
                    <option value="38">38</option>
                    <option value="39">39</option>
                    <option value="40">40</option>
                    <option value="41">41</option>
                    <option value="42">42</option>
                    <option value="43">43</option>
                    <option value="44">44</option>
                    <option value="45">45</option>
                    <option value="46">46</option>
                    <option value="47">47</option>
                    <option value="48">48</option>
                    <option value="49">49</option>
                    <option value="50">50</option>
                    <option value="51">51</option>
                    <option value="52">52</option>
                    <option value="53">53</option>
                    <option value="54">54</option>
                    <option value="55">55</option>
                    <option value="56">56</option>
                    <option value="57">57</option>
                    <option value="58">58</option>
                    <option value="59">59</option>
                    <option value="60">60</option>
                    <option value="61">61</option>
                    <option value="62">62</option>
                    <option value="63">63</option>
                    <option value="64">64</option>
                    <option value="65">65</option>
                    <option value="66">66</option>
                    <option value="67">67</option>
                    <option value="68">68</option>
                    <option value="69">69</option>
                    <option value="70">70</option>
                    <option value="71">71</option>
                    <option value="72">72</option>
                    <option value="73">73</option>
                    <option value="74">74</option>
                    <option value="75">75</option>
                    <option value="76">76</option>
                    <option value="77">77</option>
                    <option value="78">78</option>
                    <option value="79">79</option>
                    <option value="80">80</option>
                    <option value="81">81</option>
                    <option value="82">82</option>
                    <option value="83">83</option>
                    <option value="84">84</option>
                    <option value="85">85</option>
                    <option value="86">86</option>
                    <option value="87">87</option>
                    <option value="88">88</option>
                    <option value="89">89</option>
                    <option value="90">90</option>
                    <option value="91">91</option>
                    <option value="92">92</option>
                    <option value="93">93</option>
                    <option value="94">94</option>
                    <option value="95">95</option>
                    <option value="96">96</option>
                    <option value="97">97</option>
                    <option value="98">98</option>
                    <option value="99">99</option>
                </select>　歳
                    </td>
                </tr>
                <tr>
                    <th>学歴</th>
                    <td>
                    <select name="learn">
                    <option value="">選択してください</option>
                    <option value="高卒">高卒</option>
                    <option value="大学卒">大学卒</option>
                    <option value="大学院卒">大学院卒</option>
                    <option value="短大・専門学校卒">短大・専門学校卒</option>
                    <option value="その他">その他</option>
                </select>
                    </td>
                </tr>
                <tr>
                    <th>仕事</th>
                    <td>
                    <select name="job">
                    <option value="">選択してください</option>
                    <option value="公務員">公務員</option>
                    <option value="経営者・役員">経営者・役員</option>
                    <option value="会社員">会社員</option>
                    <option value="自営業">自営業</option>
                    <option value="自由業">自由業</option>
                    <option value="専業主婦">専業主婦</option>
                    <option value="パート・アルバイト">パート・アルバイト</option>
                    <option value="学生">学生</option>
                    <option value="その他">その他</option>
                </select>
                    </td>
                </tr>
                <tr>
                    <th>紹介文</th>
                    <td>
                    <textarea name="intro" id="intro" cols="30" rows="10" required><?php echo $recs['intro'] ; ?></textarea>
                    </td>
                </tr>
            </tbody>
        </table>
        <input type="submit" class="btn btn-outline-primary submit" name="sent" value="sousin">
    </form>
</div>
    <?php
    }
}
if(isset($_POST["send"])) {
    delete();
    insert1();
}
if(isset($_POST["sent"])) {
    insert2();
}
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/st.css">
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<title>プロフィール変更</title>
</head>
<body>
<!-- プロフィール変更 -->
<div class="container" id="gallery">
<!-- Button trigger modal -->
    <div class="main">
    <?php select1() ?>
        
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
                    <input type="submit" name="ok" class="btn btn-primary ml-1"  value="OK">
                </div>
            </form>
            </div>
        </div>
    </div>


    <div class="thumb">
        
    <?php 
    for($i = 1; $i<=5; $i++){
    ?>

        <?php select3() ?>
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
    <div id ="mylist">     
        <div class="detail_box">
            <h3>基本情報</h3>
            <?php intro() ?>
        </div>
    </div>
    <a class="check" href="pro.php">プロフィール確認</a>
    

</div>
<script type="text/javascript" src="js/app.js"></script>
<script src="js/bubbly-bg.js"></script>
<script>bubbly();</script>
</body>
</html>
