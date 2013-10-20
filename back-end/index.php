<?php
	require_once 'include/class/member.php';
	$member = new Member();
?><!DOCTYPE html>
<html lang="zh-TW">
<head>
<meta charset="utf-8">
<meta name="description" content="library">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<![endif]-->
<title>個人圖書館</title>
<link rel="stylesheet" href="static/css/reset.css">
<link rel="stylesheet" href="static/css/bootstrap.min.css">
<link rel="stylesheet" href="static/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="static/css/common.css">
<script src="static/js/jquery-2.0.3.min.js"></script>
<script src="static/js/bootstrap.min.js"></script>
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand chinese" href="/">個人圖書館</a>
    </div>
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li><a class="chinese" href="#about">關於</a></li>
        <li><a class="chinese" href="#explore">隨意看看</a></li>
        <li><a class="chinese" href="#contact">聯絡我們</a></li>
      </ul>
<?php
	if (is_null($member::$username)) {
?>
	<form class="navbar-form navbar-right" action="signin" method="post">
		<div class="form-group">
			<input name="username" type="text" placeholder="Email" class="form-control">
		</div>
		<div class="form-group">
			<input name="password" type="password" placeholder="Password" class="form-control">
		</div>
		<button type="submit" class="btn btn-primarychinese chinese">登入</button>
		<a class="btn btn-success chinese" href="register">註冊</a>
	</form>
<?php
	} else {
?>
	<ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle chinese" data-toggle="dropdown">個人功能 <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a class="chinese" href="books">我的藏書</a></li>
            <li><a class="chinese" href="friends">好友名單</a></li>
            <li><a class="chinese" href="borrowlist">借閱列表</a></li>
            <li class="divider"></li>
            <li><a class="chinese" href="qrcode">取得 API 金鑰</a></li>
            <li><a class="chinese" href="logout">登出</a></li>
          </ul>
        </li>
	</ul>
<?php
	}
?>
    </div><!--/.navbar-collapse -->
  </div>
</div>
<div class="text-center"><img src="static/img/e86f655087d960fb3dd13665f1c804f6.gif"></div>
<div class="well chinese">
	<p>　　為學日益，擁書萬卷以為常備；積文以援翰，累墨以寫心；或啟新見，或發奇思，遂購置書籍數冊，長我之志，以采鄙室。室之美始於窗明几淨，人之美起於心神澂瑩。斯文在茲乎，寧庸人傷？惟夫卷冊浩繁而弗易治，常人多雜湊之，或謂亂中之有序，則懷揣稀世珍寶而不自知也；往來友朋借覽而忘還，掛一漏萬，豈為道日損哉？美玉於斯，大幸莫過有以知，薦借所愛書不韞櫝，良友比朋。是以治學首需別錄，錄明則薦借有方，始得豪語曰：「不讀三千卷書不出此室」，不虧於一冊失也。</p>
</div>
</body>
</html>