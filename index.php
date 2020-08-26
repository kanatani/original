<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/style.css">
<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Raleway+Dots&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&family=Noto+Serif+JP:wght@200&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
<link rel="shortcut icon" href="favicon.ico">
<meta name="description" content="親友を探すのに特化したマッチングアプリ[connecting]">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src="js/jquery.bgswitcher.js"></script>
<title>connecting</title>
<style>
.back {
  border-radius: 0 0 700px 700px / 0 0 40px 40px;
}

.back-img {
  background-size:cover;
  border-radius: 0 0 700px 700px / 0 0 40px 40px;
}
</style>
</head>
<body>
<div class="back">
    <div class="back-img">
        <h1>connecting</h1>
        <nav>
            <ul>
                <li>
                    <a href="top.php" class="start_connect">login</a>
                </li>
                <li>
                    <a href="sinki.html" class="new_connect">sign up</a>
                </li>
            </ul>
        </nav>
        <p>深いつながりを</p>
    </div>
</div>
<div id="main_messages">
    <div id="main_text">
        <h1 class="main_title">親友を探そう</h1>
        <p>私たちの人生を大きく左右させるのは</p>
        <p>人間関係と言っても過言ではありません。</p>
        <h1 class="my_name">connecting</h1>
        <p>このアプリはより良い人間関係を築くのを</p>
        <p>手助けします。</p>
    </div>
</div>

<div id="function">
    <div id="function_detail">  
        <h2>connecting function</h2>
            <div id="function_text">
                <i class="fas fa-search fa-4x"></i>
                <h3>気の合う人を探そう</h3>
                <p>好きなこと、嫌いなことを見ながら、自分と気が合いそうな人を見つけてみよう!</p>
            </div>
            <div>
                <i class="far fa-kiss-wink-heart fa-4x"></i>
                <h3>いいね機能</h3>
                <p>気の合いそうな人たちを見つけたらいいねをしてみよう!</p>
            </div>
            
            <div>
                <i class="far fa-handshake fa-4x"></i>
                <h3>チャット機能</h3>
                <p>互いにいいねを押したらチャットができるようになります！</p>
            </div>
    </div>
</div>

<footer>
    <div id="footer_navi">
        <ul>
            <li><a href="connect.php">top</a></li>
            <li><a href="top.php">login</a></li>
            <li><a href="sinki.html">sign up</a></li>
        </ul>
    </div>

</footer>
<script>
    $(function(){
        $('.back-img').bgSwitcher({
            images: ['img/shutterstock_1033414606.jpg','img/shutterstock_367703579.jpg','img/shutterstock_552753190.jpg'], // 切り替える背景画像を指定
            interval: 5000, // 背景画像を切り替える間隔を指定 3000=3秒
            loop: true, // 切り替えを繰り返すか指定 true=繰り返す　false=繰り返さない
            shuffle: true, // 背景画像の順番をシャッフルするか指定 true=する　false=しない
            effect: "fade", // エフェクトの種類をfade,blind,clip,slide,drop,hideから指定
            duration: 3000, // エフェクトの時間を指定します。
            easing: "swing" // エフェクトのイージングをlinear,swingから指定
        });
   
        $(window).scroll(function() {
            $('#main_text').each(function(){
                var position = $(this).offset().top;
                var scroll = $(window).scrollTop();
                var windowHeight = $(window).height();
                if (scroll > position - windowHeight + 200){
                    $(this).addClass('active');
                }
            });

            $('#function_detail').each(function(){
                var position = $(this).offset().top;
                var scroll = $(window).scrollTop();
                var windowHeight = $(window).height();
                if (scroll > position - windowHeight + 100){
                    $(this).addClass('in');
                }
            });
        });
    });
</script>
</body>
</html>