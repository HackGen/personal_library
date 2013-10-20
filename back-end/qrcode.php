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
<link rel="stylesheet" href="static/css/starter-template.css">
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
        <li><a class="chinese" href="#explore">清風翻書</a></li>
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
<div class="container">
	<div class="starter-template">
		<img id="qrcode" data-src="holder.js/200x200" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMgAAADICAYAAACtWK6eAAAG/ElEQVR4Xu3ZvU8UDQCE8UVQYmFhwUdCRWylNCT++1Y0hM7YkRja62hAwOwla+69yPHuiCFxflTq3WRvntmH3T23FovFw+AHAQR+S2CLIM4MBB4nQBBnBwIbCBDE6YEAQZwDCGQEXEEyblIlBAhSMrSaGQGCZNykSggQpGRoNTMCBMm4SZUQIEjJ0GpmBAiScZMqIUCQkqHVzAgQJOMmVUKAICVDq5kRIEjGTaqEAEFKhlYzI0CQjJtUCQGClAytZkaAIBk3qRICBCkZWs2MAEEyblIlBAhSMrSaGQGCZNykSggQpGRoNTMCBMm4SZUQIEjJ0GpmBAiScZMqIUCQkqHVzAgQJOMmVUKAICVDq5kRIEjGTaqEAEFKhlYzI0CQjJtUCQGClAytZkaAIBk3qRICBCkZWs2MAEEyblIlBAhSMrSaGQGCZNykSggQpGRoNTMCBMm4SZUQIEjJ0GpmBAiScZMqIUCQkqHVzAgQJOMmVUKAICVDq5kRIEjGTaqEAEFKhlYzI0CQjJtUCQGClAytZkaAIBk3qRICBCkZWs2MAEEyblIlBAhSMrSaGQGCZNykSggQpGRoNTMCBMm4SZUQIEjJ0GpmBAiScZMqIUCQkqHVzAgQJOMmVUKAICVDq5kRIEjGTaqEAEFKhlYzI0CQjJtUCQGClAytZkaAIBk3qRICBCkZWs2MAEEyblIlBAhSMrSaGQGCZNykSggQpGRoNTMCBMm4SZUQIEjJ0GpmBAiScZMqIUCQkqHVzAgQJOMmVUKAICVDq5kRIEjGTaqEAEFKhlYzI0CQjJtUCQGClAytZkaAIBk3qRICBCkZWs2MAEEyblIlBAhSMrSaGQGCZNykSggQpGRoNTMCBMm4SZUQIEjJ0GpmBAiScZMqIUCQkqHVzAgQJOMmVUKAICVDq5kRIMhMbufn58NisfiVOj4+Hj58+LD8+/jvFxcXw/39/bC1tTV8/vx5ePv27ZOvPfURXuKYT32mltcJMmPpr1+/DldXV8MkxXTifvz4cdjf3x/Ozs6GV69eDZ8+fVr++e7ubjg9PR22t7cffe3169cbP8FLHHMGkn/+rQT5g4m/f/8+fPv2bTg4OBiOjo6WV4+9vb3h5ORkmE7sUZ43b948+trh4eGsT/ASx5z1Af+xNxPkDwZd/e0+SjDKMl1dphN5/Pum196/f7+U5+HhYXlLtru7u7zaXF9fD6Nc6wI9xzGnW8I/qF4TJUg49Y8fP4YvX74snzfGE/vy8vI/t1+rv+l3dnYefW31ajNeidbfu/rxnvOYYe26GEHCyafnj+mKsf6sMEeQUbLpqjF+nHfv3i2fXdZ/nvOYYe26GEGCyScZxt/44xVg/Fm9pRpvYf7vLdbvvgHbdGv1nMcMqtdFCDJz8unEX/8tv3rFWH9Iv729/fUwv/7a+Iwx3TqN33aNf56eR6aviP/GMWfWrn07QWZMP53I49e367/lp9uk5Gve1a+LJ5kmAf/WMWfUrn4rQWbMP91arUem257Vk3n9Pwofe+13V4fVZ42bm5vlA/5zHnNG5fq3EqT+FABgEwGCOD8Q2ECAIE4PBAjiHEAgI+AKknGTKiFAkJKh1cwIECTjJlVCgCAlQ6uZESBIxk2qhABBSoZWMyNAkIybVAkBgpQMrWZGgCAZN6kSAgQpGVrNjABBMm5SJQQIUjK0mhkBgmTcpEoIEKRkaDUzAgTJuEmVECBIydBqZgQIknGTKiFAkJKh1cwIECTjJlVCgCAlQ6uZESBIxk2qhABBSoZWMyNAkIybVAkBgpQMrWZGgCAZN6kSAgQpGVrNjABBMm5SJQQIUjK0mhkBgmTcpEoIEKRkaDUzAgTJuEmVECBIydBqZgQIknGTKiFAkJKh1cwIECTjJlVCgCAlQ6uZESBIxk2qhABBSoZWMyNAkIybVAkBgpQMrWZGgCAZN6kSAgQpGVrNjABBMm5SJQQIUjK0mhkBgmTcpEoIEKRkaDUzAgTJuEmVECBIydBqZgQIknGTKiFAkJKh1cwIECTjJlVCgCAlQ6uZESBIxk2qhABBSoZWMyNAkIybVAkBgpQMrWZGgCAZN6kSAgQpGVrNjABBMm5SJQQIUjK0mhkBgmTcpEoIEKRkaDUzAgTJuEmVECBIydBqZgQIknGTKiFAkJKh1cwIECTjJlVCgCAlQ6uZESBIxk2qhABBSoZWMyNAkIybVAkBgpQMrWZGgCAZN6kSAgQpGVrNjABBMm5SJQQIUjK0mhkBgmTcpEoIEKRkaDUzAgTJuEmVECBIydBqZgQIknGTKiFAkJKh1cwIECTjJlVCgCAlQ6uZESBIxk2qhABBSoZWMyNAkIybVAkBgpQMrWZGgCAZN6kSAgQpGVrNjABBMm5SJQR+AvP6XRytYjPeAAAAAElFTkSuQmCC" class="img-thumbnail" alt="200x200" style="width: 200px; height: 200px;"><br><br>
		<button id="qrlink" type="button" class="btn btn-xs btn-default disabled">Show API Key (QRcode)</button>
	</div>
</div>
<?php
	$dbh = PDO_Inst();
	$sth = $dbh->prepare("SELECT * FROM `members` WHERE `email` = :username");
	$sth->execute(array(':username' => $member::$username));
	$query = $sth->fetchAll(PDO::FETCH_ASSOC);
	foreach ($query as $item) {
		$token = $item['identity'];
	}
	$username = $password = NULL;
?>
<script>
	window.thumbnail200 = $('#qrcode').attr('src');
	$('#qrlink').removeClass('disabled').on('click', function() {
		$qrcode = $('#qrcode');
		$qrcode.attr('src', 'http://chart.apis.google.com/chart?cht=qr&chs=200x200&chl=<?php echo($token); ?>&chld=H|0');
		if (window.qrcountdown) {
			clearTimeout(window.qrcountdown);
			window.qrcountdown = false;
		}
		window.qrcountdown = setTimeout(function() {
			$qrcode.attr('src', window.thumbnail200);
			window.qrcountdown = false;
		}, 60000)
	});
</script>
</body>
</html>