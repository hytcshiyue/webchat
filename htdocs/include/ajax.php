<?php
		session_start();

		include_once "ez_sql_core.php";
	    include_once "ez_sql_mysql.php";

		$flag = isset($_POST["flag"])?$_POST["flag"]:"";
		$msg = isset($_POST["msg"])?$_POST["msg"]:"";
		$senderid = isset($_POST["senderid"])?$_POST["senderid"]:"";
		$receiverid = isset($_POST["receiverid"])?$_POST["receiverid"]:"";

		$db=new ezSQL_mysql();
		$curUserID=isset($_SESSION["wodeid"])?$_SESSION["wodeid"]:"";
		$msgSender=isset($_POST["msgSender"])?$_POST["msgSender"]:"";

		if($flag=="sendMsg"){
				$sql="insert into messageinfo(id,msgContent,msgSender,msgReceiver,msgSendTime,msgState)";
				$sql.="values(null,'$msg',$senderid,$receiverid,now(),'unread')";
				$res =$db->query($sql);
				if(!$res){
					echo "fail";
				}else{
					echo "OK";
				}
				die();
			}

			//get unread msg of curread user
		if($flag=="getUnreadMsg" ){
				if($curUserID==""){
					echo "need login";
					die();
				}
				$sql = "select * from messageinfo where msgReceiver= $curUserID and msgState ='unread'";
				$res = $db->get_results($sql);
				echo json_encode($res);
				
			}
			if($flag=="changeMsgState"){
				$sql ="update messageinfo set msgState='read' where msgSender=$msgSender";
				echo $sql;
				$res =$db->get_results($sql);
				if(!$res){
						echo "fail";
					}else {
						echo "ok";
					}
					die();
			}
			if($flag=="login"){
				$sql="update userinfo set userState='online'  where id=$curUserID" ;
				echo "$curUserID";
				$res =$db->get_results($sql);
			}
			if($flag=="logout"){
				$sql="update userinfo set userState='offline'  where id=$curUserid" ;
				// echo "$curUserid";
				$res =$db->get_results($sql);
			}
		
?>