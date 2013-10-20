<?php
require_once 'include/class/member.php';
$member = new Member();
$errormsg = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$username = isset($_POST['username']) ? $_POST['username'] : NULL;
	$password = isset($_POST['password']) ? $_POST['password'] : NULL;
	$password2 = isset($_POST['password2']) ? $_POST['password2'] : NULL;

	if (!strlen($username)) {
		$errormsg = 'Username can not be empty';
	} else if (!strlen($password)) {
		$errormsg = 'Password can not be empty';
	} else if ($password != $password2) {
		$errormsg = 'Confirm password not match';
	} else if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
		$errormsg = 'Username not a valid email address';
	} else {
		$token = md5($username.$password);
		$nickname = $username;
		$access = 0;
		$dbh = PDO_Inst();
		$sth = $dbh->prepare("INSERT INTO `members` (`email`, `password`, `identity`, `nickname`, `access`) VALUES (:username, :password, :identity, :nickname, :access)");
		$sth->execute(array(':username' => $username, ':password' => sha1(md5($password)), ':identity' => $token, ':nickname' => $nickname, ':access' => $access));

		if (!$member->login($username, $password)) {
			$errormsg = 'Oops! An unknow error occurred while creating a new account';
		}
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
<title>註冊 - 個人圖書館</title>
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
    <h2 class="form-signin-heading">Join Liblibrary</h2>
    <input name="username" type="text" class="form-control" placeholder="Your email address" autofocus><br>
    <input name="password" type="password" class="form-control" placeholder="Choose a password">
    <input name="password2" type="password" class="form-control" placeholder="Confirm your password"><br>
    <button class="btn btn-lg btn-success btn-block" type="submit">Create an account</button>
  </form>
</div>
</body>
</html>