// JavaScript Document
$(document).ready(function(e) {
  $(".fstatus li").click(statusStyle);
});
function statusStyle(){
	  $(this).parents(".fstatus").toggleClass("open");
	  if(!$(this).hasClass("change")){
		  var status=$(this).find("span").html()=="在线"?0:2;
		  var _this=$(this);
		  $.ajax({
	          dataType:"JSON",
	          type:"post",
	          data:{
	        	  status:status
	          },
	          url:domain+"/communication/modifyDoctorStatus",
	          success:function(data){
	        	  if(data[0].message=="success"){
	        		  if(_this.prev()){
	        			  _this.prev().before(_this);
	        			  _this.next().removeClass("change");
	        			  _this.addClass("change");
	        			  _this.parents(".wrap").find("#rbox .status"+(status==2?1:3)).removeClass().addClass("status"+(status==2?3:1));
		    		  }
	        		  config.status=status;
	        		  $(".btn_cancel").eq(0).trigger("click");
	        	  }
	          },
	          error:function(){
	          }
	      });
	  }
}
var index=0;
//弹出框 参数type使用dialog类型 1代表计时消失 2提示类型 option参数对应的信息 {title:"头部如图片过大 表示header内容" body:"内容,可以是文字也可以是一段html内容",btn_name1:"第一个按钮名字",btn_name1:"第二个按钮名字",id:"当前弹出框id",trueFun:function(){
//单机确定按钮操作
//},cancelFun:function(){//取消时调用的方法
//},shown:"显示完成调用方法",hidden:"完成隐藏时的执行",css:"弹出框的宽改变",removeOpera:1}  element参数使用document.body    2申请出诊提示  3撤销短信通知提示 4图片过大提示 5

function dialog(type,option,element){
	option=$.extend({
		removeModal:function(elementId){
			option.currObj=elementObj=$(element).find("#"+elementId);
			elementObj.modal("hide");
		}
	},option);
	var body=[];
	element=window.top.document.body;
	switch(type){
		case 1:
			var html='<div class="bg_mask1 f_dialog1"><div class="dialog1">'+(option.title?option.title:"")+'</div></div>';
			$(element).append(html);
			var dialogObj=$(element).find(".dialog1");
			dialogObj.css({"margin-left":"-"+(dialogObj.width()/2),"margin-top":"-"+(dialogObj.height()/2)});
			dialogObj.show();
			if(option.time){
				setTimeout(function(){
					$(element).find(".f_dialog1").remove();
					option.hideExecFun&&option.hideExecFun();
				},option.time);
			}
			return;
			break;
		default:
			break;
		}
		if(!option.id){
			++index;
			option.id="modal"+index;
		}
		var html=[];
		if(type==0){
			html.push('<div class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" id="'+option.id+'">');
			html.push('<div class="modal-dialog modal-dialog1" style="'+(option.css||"")+'">');
			html.push(' <div class="modal-content">');
			html.push(' <div id="titleCss" style="height: 65px;" class="modal-header modal-header-top">');
			if(option.close_show==1)
				html.push('<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" class="close_btn"></span><span class="sr-only">Close</span></button>');
			html.push('<h4 class="modal-title">'+option.title+'</h4>');
			html.push('</div>');
			html.push('<div class="modal-body pd modal-body1">');
			html.push(option.body||body.join(""));
			html.push('</div>');
			html.push('<div id="btnCss" style="padding-top: 5px;padding-bottom: 5px;margin-bottom: 10px;" class="modal-footer modal-footer1">');
			html.push('<button type="button" class="border-r4 status4 task-anapply task-primary btn_true btn-selected-true" target="'+option.id+'">'+(option.btn_name1?option.btn_name1:"确定")+'</button>');
			if(option.btnNum!=1)
			    html.push('<button type="button" class="border-r4 task-anapp ml95 btn_cancel btn-selected-cancel" style="margin-left: 50px;" target="'+option.id+'">'+(option.btn_name2?option.btn_name2:"取消")+'</button>');
			html.push('</div>');
			html.push('</div>');
			html.push('</div></div>');
		}else{
			html.push('<div class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" id="'+option.id+'">');
			html.push('<div class="modal-dialog modal-dialog1" style="'+(option.css||"")+'">');
			html.push(' <div class="modal-content">');
			html.push(' <div id="titleCss" style="height: 65px;" class="modal-header modal-header-top">');
			if(option.close_show==1)
				html.push('<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" class="close_btn"></span><span class="sr-only">Close</span></button>');
			html.push('<h4 class="modal-title">'+option.title+'</h4>');
			html.push('</div>');
			html.push('<div class="modal-body pd modal-body1">');
			html.push(option.body||body.join(""));
			html.push('</div>');
			html.push('<div id="btnCss" style="padding-top: 5px;padding-bottom: 5px;margin-bottom: 10px;" class="modal-footer modal-footer1">');
			html.push('<button type="button" class="border-r4 status4 task-anapply task-primary btn_true btn-selected-true" target="'+option.id+'">'+(option.btn_name1?option.btn_name1:"确定")+'</button>');
			if(option.btnNum!=1)
			    html.push('<button type="button" class="border-r4 task-anapp ml95 btn_cancel btn-selected-cancel" style="margin-left: 50px;" target="'+option.id+'">'+(option.btn_name2?option.btn_name2:"取消")+'</button>');
			html.push('</div>');
			html.push('</div>');
			html.push('</div></div>');
		}
	    $(element).append(html.join(""));
    	$(element).find("#"+option.id).modal({show:true,backdrop:false});
		var modalObj=$(element).find("#"+option.id);
		//点击确定执行逻辑
		modalObj.find(".btn_true").click(function(){
			if(!option.isChange)
				changeBtnStatu($(this).attr("target"));
			option.trueFun&&option.trueFun.call(this,option.removeModal,$(this).attr("target"));
			if(!option.removeAuto)
				option.removeModal($(this).attr("target"));
	    });
		//点击取消执行逻辑
		modalObj.find(".btn_cancel").click(function(){
			option.cancelFun&&option.cancelFun.call(this);
			option.currObj=$(this.ownerDocument).find("#"+$(this).attr("target")).modal("hide");
	    });
		//显示完成
		modalObj.on('shown.bs.modal', function () {
			$(".modal-backdrop").unbind("click");
			option.shown?option.shown():"";
			//$(this.ownerDocument).find("#"+$(this).attr("target")).remove();
		});
		//隐藏完成
		modalObj.on('hidden.bs.modal', function () {
			option.hidden?option.hidden():"";
			$(option.currObj).remove();
		});
}

function changeBtnStatu(id){
	var obj=null;
	if(id)
		obj=id?$("#"+id):null;
	(obj?obj.find(".btn-selected-true"):$(".btn-selected-true")).removeClass("btn-selected-true").addClass("btn-selected-trueforbidden");
	(obj?obj.find(".btn-selected-cancel"):$(".btn-selected-cancel")).removeClass("btn-selected-cancel").addClass("btn-selected-cancelforbidden");
}
function changeBtnStatu1(id){
	var obj=null;
	if(id)
		obj=id?$("#"+id):null;
	(obj?obj.find(".btn-selected-trueforbidden"):$(".btn-selected-trueforbidden")).removeClass("btn-selected-trueforbidden").addClass("btn-selected-true");
	(obj?obj.find(".btn-selected-cancelforbidden"):$(".btn-selected-cancelforbidden")).removeClass("btn-selected-cancelforbidden").addClass("btn-selected-cancel");
}