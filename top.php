<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<title>トップページ</title>
</head>
<body>
<div class="container">
  <!-- Content here -->
    <h4>ログイン</h4>
    </br>
    <form id = "form" method = "post" action="log.php"> 
        <div class="form-group mail">
            <label for="exampleInputEmail1">Email address</label>
            <input name="gmail" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group pass">
            <label for="exampleInputPassword1">Password</label>
            <input name="netpass" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <button  type="submit" class="btn btn-primary btn">Submit</button>
    </form>
</div>
</body>
</html>

