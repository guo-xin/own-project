$(function(){
	/*滚动条样式*/
	$("#center-stroll").mCustomScrollbar({
		theme: "dark-thick"
	});
	if (document.documentElement.clientHeight !== 0) {
		var height = document.documentElement.clientHeight;
	} else {
		var height = document.body.clientHeight;
	}
	$(".doctor-management").css("height",height+"px");
	/* 添加图片默认地址	－	图片加载有问题时 调用此图片 */
	$(".list-img").attr("onerror","this.onerror=null;this.src='images/dot.png'");
})

/*btn_count按钮个数*/
/*dialog(0,{title:"重置密码",body:" 您要重置  <font color=\"red\">"+name+"</font> 医生的登录密码？",btn_count:2,btn_name1:"确认",btn_name2:"取消",trueFun:"rest_in()"});*/
function dialog(type,option){
	var html = '';
	/*头部,1代表计时消失 */
	if(type == 1){
		html += '<div class="modal-dialog" role="document" style="margin:150px auto;"><div class="modal-content primary-content">';
		html += '<div class="modal-header"><h4 style="text-align:center;">'+option.title+'</h4></div>';
	}else{
		html += '<div class="modal-dialog" role="document"><div class="modal-content primary-content">';
		html += '<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button><h4>'+option.title+'</h4></div>';
		/*中间body部分*/
		html += '<div class="modal-body"><div>'+option.body+'</div></div>';
		/*底部按钮部分*/
		if(option.btn_count == 1){
			html += '<div class="modal-footer"><input type="button" value="'+option.btn_name2+'" class="border-r4 temporary-y" onclick="window.frames[\'main_frame\'].'+option.trueFun+';$(\'#guoxin\',parent.document).trigger(\'click\');"/></div>';
		}else if(option.btn_count == 2){
			html += '<div class="modal-footer"><input type="button" value="'+option.btn_name2+'" class="border-r4 temporary" data-dismiss="modal"/>';
			html += '<input type="button" value="'+option.btn_name1+'" style="margin-left:40px;" class="border-r4 temporary-y" onclick="window.frames[\'main_frame\'].'+option.trueFun+';$(\'#guoxin\',parent.document).trigger(\'click\');"/></div>';
		}
	}
	html += '</div></div>';
	$("#editImgModal",parent.document).html(html);
	$("#guoxin",parent.document).trigger("click");
	/*计时消失 */
	if(type == 1){
		setTimeout(function(){
			$("#guoxin",parent.document).trigger("click");
			if(option.refresh == true){
				window.location.reload();
			}
		},2000)
	}
}
