<?php
require_once 'include/class/member.php';
$member = new Member();
$errormsg = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$username = isset($_POST['username']) ? $_POST['username'] : NULL;
	$password = isset($_POST['password']) ? $_POST['password'] : NULL;

	if (!$member->login($username, $password)) {
		$errormsg = 'The username or password is incorrect';
	}
}

if ($member::$username){
	header('Location: /');
	exit();
}
?><!DOCTYPE html>
<html lang="zh-TW">
<head>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<![endif]-->
<title>登入 - 個人圖書館</title>
<link rel="stylesheet" href="static/css/reset.css">
<link rel="stylesheet" href="static/css/bootstrap.min.css">
<link rel="stylesheet" href="static/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="static/css/signin.css">
<script src="static/js/jquery-2.0.3.min.js"></script>
<script src="static/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<?php
	if ($errormsg) {
		echo("<div class=\"alert alert-danger\">{$errormsg}</div>");
	}
?>
  <form class="form-signin" method="post">
    <h2 class="form-signin-heading">Please sign in</h2>
    <input name="username" type="text" class="form-control" placeholder="Email address" autofocus><br>
    <input name="password" type="password" class="form-control" placeholder="Password">
    <label class="checkbox">
      <input type="checkbox" value="remember-me"> Remember me
    </label>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
	<a class="btn btn-lg btn-success btn-block" href="register">New to Liblibrary? Sign up</a>
  </form>
</div>
</body>
</html>