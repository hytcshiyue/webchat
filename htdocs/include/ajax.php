<?php
		session_start();

		include_once "ez_sql_core.php";
	    include_once "ez_sql_mysql.php";

		$flag = isset($_POST["flag"])?$_POST["flag"]:"";
		$msg = isset($_POST["msg"])?$_POST["msg"]:"";
		$senderid = isset($_POST["senderid"])?$_POST["senderid"]:"";
		$receiverid = isset($_POST["receiverid"])?$_POST["receiverid"]:"";

		$db=new ezSQL_mysql();

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
		
?>