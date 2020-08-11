<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/st.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<title>トップページ</title>
</head>
<body>
<div class="container top_page">
  <!-- Content here -->
    <h4>ログイン</h4>
    </br>
    <div class="loguin">
        <form id = "mit" method = "post" action="log.php"> 
            <div class="form-group mail">
                <label for="exampleInputEmail1">Email address</label>
                <input name="gmail" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>

            <div class="form-group pass">
                <label for="exampleInputPassword1">Password</label>
                <input name="netpass" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <button  type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
        </form>

        <div class="sinki">
            新規登録がまだの方はこちらにアクセスしてください。
            </br>
            <div class="alert alert-info" role="alert">
                <a href="sinki.html" class="alert-link">新規登録</a>
            </div>
        </div>
    </div>
</div>



<script src="http://cdn.jsdelivr.net/mojs/latest/mo.min.js"></script>
<script src="js/bubbly-bg.js"></script>
<script>bubbly();</script>
</body>
</html>

