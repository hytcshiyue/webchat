<?php 
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="login.css">
	<!-- // <script type="text/javascript" src="js/jquery-ui.min.js"></script>
	// <script type="text/javascript" src="js/index.js"></script>
</head> -->
<body>
	<div id="login">
		<span>用户登陆</span>
		<form action="index.php"  method="post" >
			<p>用户名：<input name="userid" type="text" id="txtUserid" /></p>
			<p>密  码 ：<input name="userpwd" type="password" id="txtUserPwd" /></p>
			<p><input type="submit" value="登陆" id="log-sub"/></p>
		</form>
	</div>
	<?php
	$info =isset($_GET["error"])?$_GET["error"]:"";
	$logout =isset($_GET["logout"])?$_GET["logout"]:"";
	if($info=="wrongpwd"){
		// $js = 'alert("fail to login !") ';
		echo "<script>tiao();</script>";
	}
	if($logout=="yes"){
		unset($_SESSION["wodeid"]);
		unset($_SESSION["wodenicheng"]);
	}
?>
</body>
</html>