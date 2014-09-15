
function tiao(){
	alert("fail to login!login it again please!");
}

$(function(){
	chathtml();
	iniDelegate();
	// setInterval('getUnreadMsg()',1000);
	getUnreadMsg();
	
});
//获取自己的所有未读消息
// function getUnreadMsg(){
// 		$ajax({
// 			type:"POST",
// 			url:"include/ajax.php",
// 			data:{flag:'getUnreadMsg'},
// 			success:function(res){
// 				var objs=eval("("+res+")");
// 				$.each(objs,function(){
// 					alert(this.msgContent);
// 				});

// 			}
// 		});
// }
function chathtml(){
	
	
	$(".friendli").click(function(){
		alert ("sdv");
		var talkid=$(this).attr("talkid");
		var talkname=$(this).attr("talkname");
		var isshow=$(this).attr("isshow");
		var isappear=$(this).attr("isappear");
		
		if(isshow="no"){
			$(this).attr("isshow","yes");
			if(isappear="no"){
				var chathtmlB='';
					chathtmlB +='<div id="'+talkid+'" class="chatContent">';
					chathtmlB +='   <div class="chatname"><span class="cnName">与   '+talkname+'  聊天中</span><a class="cnClose" href="#">关闭</a></div>';
					chathtmlB +='   <div class="chatcontent">';
					chathtmlB +='   </div>';
					chathtmlB +='   <div class="chatsend">';
					chathtmlB +='   	<input class="csInput" maxlength="4000" type="text"/>';
					chathtmlB +='       <button class="csBtn"><span>Send</span></button>';
					chathtmlB +='   </div>';
					chathtmlB +='</div>';
					chathtmlB +='';

					$("#right").append(chathtmlB);
					$(this).attr("isappear","yes");
			}
			else{	
				$("#"+talkid).show();
			}	
		}
		$(".chatContent").css("z-index","1");
		$("#"+talkid).css("z-index","22");
		$(".cnClose").click(function(){
			var talkidN = $(this).parent().parent().attr("id");
			$(".friendli[talkid='"+talkidN+"']").attr("isshow","no");
			$("#"+talkid).hide();
			
		});

		$("#"+talkid).draggable({ 
			handle: ".talkboxtitle" ,
			containment: "parent"
		});
	});
}

function iniDelegate(){
	// $(".friendli").click(function(){
	// 	var istalking=$(this).attr("istalking");
	// 	if(istalking=="yes"){
	// 		return;
	// 	}
	// 	$(".friendli").attr("istalking","no");
	// 	$(this).attr("istalking","yes");

	// 	$("#chatContent").show();

	// 	var friendNotename=$(this).attr("friendNotename");
	// 	var friendid=$(this).attr("friendid");
	// 	$(".cnName").html("与    "+friendNotename+"    聊天中");
	// 	$(".csBtn").attr("friendli",friendid);
	// });
	$(".csBtn").click(function(){
		var msg =$(".csInput").val();
		if(msg==""){
			return;
		}
		
		//通过ajax,将消息插入数据库的表中,并显示在对话框中
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
		$(this).prev().val(" ");
		var MyHeadImage=$(".headImg").attr("curHeadImageUrl");

		var chathtmlA ='';
				
			    chathtmlA +='	<div class="send">';
			    chathtmlA +='		<div class="senderHeader"><img src=" '+MyHeadImage+' " class="headImage"  /></div>';
			    chathtmlA +='       <div class="senderLeft">';
			    chathtmlA +='		   <div class="senderLwords">'+msg+'</div>';
			    chathtmlA +='	    </div>';
			    chathtmlA +='	</div>';
			    
			$(this).parent().prev(".chatcontent").append(chathtmlA);

	});
	// 关闭对话框
	$(".cnClose").click(function(){
		$(this).parent().parent().hide();
		$(".friendli").attr("istalking","no");
	});
}

