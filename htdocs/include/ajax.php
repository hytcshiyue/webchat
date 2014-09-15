<?php
		session_start();

		include_once "ez_sql_core.php";
	    include_once "ez_sql_mysql.php";

		$flag = isset($_POST["flag"])?$_POST["flag"]:"";
		$msg = isset($_POST["msg"])?$_POST["msg"]:"";
		$senderid = isset($_POST["senderid"])?$_POST["senderid"]:"";
		$receiverid = isset($_POST["receiverid"])?$_POST["receiverid"]:"";

		$db=new ezSQL_mysql();
		// $curUserID=isset($_SESSION["wodeid"])?$_SESSION["wodeid"]:"";
		// if($curUserID==""){
		// 	echo 'need login';
		// 	die();
		// }
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
			// if($flag=="getUnreadMsg"){
			// 	if($curUserID!=""){
			// 		echo "neeed login";
			// 		die();
			// 	}
			// 	$sql = "select * from messageinfo where msgReceiver=$curUserID and msgState='unread' ";
			// 	$res = $db->get_result($sql);

			// 	echo json_encode($res);
				
			// }
		
?>