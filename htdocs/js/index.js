
function tiao(){
	alert("fail to login!login it again please!");
}

$(function(){
	iniDelegate();
});

function iniDelegate(){
	$(".friendli").click(function(){
		var istalking=$(this).attr("istalking");
		if(istalking=="yes"){
			return;
		}
		$(".friendli").attr("istalking","no");
		$(this).attr("istalking","yes");

		$("#chatContent").show();

		var friendNotename=$(this).attr("friendNotename");
		var friendid=$(this).attr("friendid");
		$(".cnName").html("与    "+friendNotename+"    聊天中");
		$(".csBtn").attr("friendli",friendid);
	});
	$(".csBtn").click(function(){
		var msg =$(".csInput").val();
		if(msg==""){
			return;
		}
		
		//通过ajax,将消息插入数据库的表中
		var receiverid= $(this).attr("friendid");
		var senderid=$(".info").attr("curuserid");
		$.ajax({
			type:"POST",
			url:"include/ajax.php",
			data:{flag:'sendMsg',msg:msg,senderid:senderid,receiverid:senderid},
			success:function(res){
				alert(res);
			}
		});
	});
	$(".cnClose").click(function(){
		$(this).parent().parent().hide();
	});
}
