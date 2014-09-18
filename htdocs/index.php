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
			$_SESSION["wodeid"]=$userid;
			$_SESSION["wodenicheng"]=$res->userNickname;

			//echo "success to login! welcome " . $_SESSION["wodeid"];
		}
	} 

	$curid = isset($_SESSION["wodeid"])?$_SESSION["wodeid"]:"" ;
	$curnicheng = isset($_SESSION["wodenicheng"])?$_SESSION["wodenicheng"]:"" ;
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
	<script type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="js/index.js"></script>
</head>
<body>
		<div id="left">
  			<a href="login.php?logout=yes">return</a>
  			<ul id="Myinfo" curuserid="<?php echo  $curid; ?>">
				<?php
  			$db=new ezSQL_mysql();
  			$res=$db->get_row("select * from userinfo where id=$curid");

  			$MyHeadImage=$res->userHeadImage;
  			$myshuoshuo=$res->myShuoshuo;
  			echo "
  				<div class='MyHeadImage'><img src='$MyHeadImage' curHeadImageUrl='".$MyHeadImage."' class='headImg' /></div>
  			  <div class='mYXinxi'>
  					 <p class='nicheng'>".$curnicheng."</p>
             <div class='xinxiA'>  
                <span class='qianming'>".$myshuoshuo."</span>
                <i class='xiugai'>修改</i>
            </div>
  				</div>
  			"	
  				?> 					  		
  			</ul>
  			<ul id="friendslist">
  			<ul id="onlinefriendslist">
  				<?php
  					// echo $curid;
  					$db=new ezSQL_mysql();
  					$res=$db->get_results("select userinfo.id,userinfo.userNickname,userinfo.userHeadImage,friendsinfo.friendNoteName,friendsinfo.friendid, friendsinfo.friendShuoshuo,userinfo.userState from userinfo,friendsinfo where userinfo.id=friendsinfo.friendid and friendsinfo.userid=$curid ");
  					$onlineHtml="";
  					$offlineHtml="";
  					if($res){
  						// echo "<script>alert('d')</script>";
  						foreach ($res as $friend) {
  							$curid = $friend ->friendid;
  							$curHeadImageUrl = $friend->userHeadImage;
  							$curuserState=$friend->userState;
  							$curfriNickname=$friend->friendNoteName;
  							$curfrishuoshuo=$friend->friendShuoshuo;
  							if($curuserState=="online"){
  								$onlineHtml.="<li id='friendlitalk$curid' talkid='$curid' talkname='$curfriNickname' class='friendli' isshow='no' isappear='no' friendImg='".$curHeadImageUrl."'>
  													<img src='$curHeadImageUrl' class='friHeadImge' />
  													<div class='Friendxinxi'>
                                <div class='FriendXX'>
                                  <span class='nicheng'>".$curfriNickname."</span>
                                  <span class='friendstate'>[  ".$curuserState."   ]</span>
                                </div>
  										  				<p class='qianming'>".$curfrishuoshuo."</p>
  													</div>
  								       		   </li>";
  								
  							}else{
  								$offlineHtml.="<li id='friendlitalk$curid' talkid='$curid' talkname='$curfriNickname' class='friendli' isshow='no' isappear='no' friendImg='".$curHeadImageUrl."'>
  													<img src='$curHeadImageUrl' class='friHeadImge offlinePic' />
  													<div class='Friendxinxi'>
  										  				<div class='FriendXX'>
                                  <span class='nicheng'>".$curfriNickname."</span>
                                  <span class='friendstate'>[  ".$curuserState."   ]</span>
                                </div>
  										  				  <p class='qianming'>".$curfrishuoshuo."</p>
  													</div>
  												</li>";
  							}
  						}echo $onlineHtml;
  					}
  					
  				?>
  			</ul>
  			<ul id="offlinefriendslist">
  				<?php
  					echo $offlineHtml;
  				?>
  			</ul>
  			</ul>
		</div>
  		<div id="right">
  		
  		</div>
</body>
</html>