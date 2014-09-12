<?php 
	include_once "include/ez_sql_core.php";
	include_once "include/ez_sql_mysql.php";
	session_start();
	$userid = isset($_POST["userid"])?$_POST["userid"]:"" ;
	$userpwd = isset($_POST["userpwd"])?$_POST["userpwd"]:"" ;
	if($userid != "" && $userpwd != ""){
		$db = new ezSQL_mysql();
		$sql="select * from userinfo where id='". $userid . "'and userpwd='" . $userpwd ." '";
		$res=$db->get_row($sql);
		if(!$res){
			// echo "fail to login!";
			header("location:login.php?error=wrongpwd");
			die();
		}
		else{
			//将当前成功登陆的人的消息  写入到session中
			$_SESSOIN["wodeid"]=$userid;
			$_SESSOIN["wodenicheng"]=$res->userNickname;
			//echo "success to login! welcome " . $res->userNickname;
		}
	} 

	$curid = isset($_SESSOIN["wodeid"])?$_SESSOIN["wodeid"]:"" ;
	$curnicheng = isset($_SESSOIN["wodenicheng"])?$_SESSOIN["wodenicheng"]:"" ;
	if($curid==""){
		header("location:login.php?error=needlogin");
		die();
	}else{
		// echo "welcome $curnicheng";
	}


	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>web chat</title>
	<link rel="stylesheet" type="text/css" href="login.css">
	<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="js/index.js"></script>
</head>
<body>
  		<a href="login.php?logout=yes">return</a>
  		<ul id="Myinfo">
  	<!-- 	<?php
  			$db=new ezSQL_mysql();
  			$res=$db->get_results("select * from userinfo where id=$curid");
  			$MyHeadImage=$user->userHeadImage;
  			$mynicheng=$user->userNickname;
  			$myqianming=$user->myShuoshuo;
  			echo "
  				<div class='MyHeadImage'><img src='$MyHeadImage'/></div>
  			    <div class='mYXinxi'>
  					<p class='nicheng'>$mynicheng</p>
  					<p class='qianming'>$myqianming</p>
  				</div>
  			";	
  		?> -->
  			
  										  		
  		</ul>
  		<ul id="friendslist">
  			<ul id="onlinefriendslist">
  				<?php
  					// echo $curid;
  					$db=new ezSQL_mysql();
  					$res=$db->get_results("select userinfo.id,userinfo.userNickname,userinfo.userHeadImage,friendsinfo.friendNoteName,friendsinfo.friendShuoshuo,userinfo.userState from userinfo,friendsinfo where userinfo.id=friendsinfo.friendid and friendsinfo.userid=$curid ");
  					$onlineHtml="";
  					$offlineHtml="";
  					if($res){
  						foreach ($res as $friend) {
  							$curHeadImageUrl = $friend->userHeadImage;
  							$curuserState=$friend->userState;
  							$curfriNickname=$friend->friendNoteName;
  							$curfrishuoshuo=$friend->friendShuoshuo;
  							if($curuserState=="online"){
  								$onlineHtml.="<li friendid='$friend->id' friendNoteName='$friend->friendNoteName' class='friendli'>
  													<img src='$curHeadImageUrl' class='friHeadImge' />
  													<div class='Friendxinxi'>
  										  				<p class='nicheng'>$curfriNickname</p>
  										  				<p class='qianming'>$curfrishuoshuo</p>
  													</div>
  								       		   </li>";
  								
  							}else{
  								$offlineHtml.="<li friendid='$friend->id' friendNoteName='$friend->friendNoteName' class='friendli'>
  													<img src='$curHeadImageUrl' class='friHeadImge offlinePic' />
  													<div class='Friendxinxi'>
  										  				<p class='nicheng'>$curfriNickname</p>
  										  				<p class='qianming'>$curfrishuoshuo</p>
  													</div>
  												</li>";
  							}
  						}
  					}
  					echo $onlineHtml;
  				
  				?>
  			</ul>
  			<ul id="offlinefriendslist">
  				<?php
  					echo $offlineHtml;
  				?>
  			</ul>
  		</ul>
  		<div id="chatContent">
  			<div class="chatname">
  					<span class="cnName"></span>
  					<a class="cnClose" href="#">关闭</a>
  			</div>
  			<div class="chatcontent">
  				<div class="send">
  					<div class="senderHeader"><img src="headimages/0.png"></div>
  					<div class="senderLeft">
  						<div class="senderLwords"></div>
  					</div>
  				</div>
  			</div>
  			<div class="chatsend">
  				<input class="csInput" maxlength="4000" type="text"/>
  				<button class="csBtn">
  					<span>Send</span>
  				</button>	
  			</div>
  			<div class="info" curuserid="<?php echo $curid; ?>"></div>
  		</div>
</body>
</html>