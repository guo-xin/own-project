<%@ page language="java" pageEncoding="UTF-8"%>
<%@ include file="/WEB-INF/views/taglibs.jsp" %>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>全部医生</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script type="text/javascript" src="${webroot}/common/js/common.js"></script>
<style>
.two,.tree{display:none;}
input[type=file]{position: absolute;
left: 0;
top: 0;
background: rgba(0,0,0,0);
width: 82px;
height: 34px;
opacity: 0;
cursor: pointer;}
.sort{
   float: right;
   margin-top:17px;
  }
#mCSB_1_container{
	position:relative; 
	top:0; 
	left:0;
	margin-left: 5px;
	width: 1230px;
}
</style>
<script type="text/javascript">
var pageConfig = {"url":'/doctor/page',"offset":1,"totalPage":${pagemodel.totalPage},"limit":${pagemodel.limit},"total":${pagemodel.total}};
var sortFlag = 1;//0降序，1升序
var sortName = "1"
function queryPageForJSON(){
	//降序
	if(sortFlag==0){
		pageConfig["sort"] = sortName;
		pageConfig["order"] = "desc";
	}else if(sortFlag==1){
		pageConfig["sort"] = sortName;
		pageConfig["order"] = "";
	}
	var realname = $("#realnameExc").val();
	var hospital = $("#hospitalExc").val();
	var department = $("#departmentExc").val();
	
	if(realname==''||realname==undefined){
	}else{
		pageConfig["realname"] = realname; 
	}
	if(hospital==''||hospital==undefined){
	}else{
		pageConfig["hospitalId"] = hospital; 
	}
	if(department==''||department==undefined){
	}else{
		pageConfig["department"] = department; 
	}
	
	$.ajax({
		url:pageConfig.url,
	    data: pageConfig,
		dataType: "json",
		method:"post",
		timeout: 10000,//超时10秒
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			if (textStatus == "timeout") { // 请求超时
				
			} else { // 其他错误，如网络错误等
		
			}
		},
		success: function (data,textStatus) {
			//设置分页信息
			pageConfig.totalPage=data.totalPage;//设置页面总数
			pageConfig.total=data.total;//设置数据总数
			
			var jsonArray = data.results;
			
			var dataTRs0 ="";
			if(jsonArray == null){
				dataTRs0 = "<div class=\"search-mod\" style=\"clear:both;\" align=\"center\">查询无结果</div>";
			}
			for(var i=0;i<jsonArray.length;i++){
				var doc = jsonArray[i];
				
				//调用端页面（刷新）逻辑
				var dataTRs = "<tr>"
	            +"<td width=\"100\" height=\"27\">"+doc.id+"</td>"
	            +"<td width=\"3\"></td>"
	            +"<td width=\"140\">"+doc.realname+"</td>"
	            +"<td width=\"3\"></td>"
	            +"<td width=\"160\">"+doc.department+"</td>"
	            +"<td width=\"3\"></td>"
	            +"<td width=\"160\">"+doc.hospital+"</td>"
	            +"<td width=\"3\"></td>"
	            +"<td width=\"160\">"+doc.mobilephone+"</td>"
	            +"<td width=\"3\"></td>"
	            +"<td width=\"90\">"+doc.invitecode+"</td>"
	            +"<td width=\"3\"></td>"
	            +"<td>";
	            
	            var dataDIV="<div class=\"search-other fr_right\">";
	            
	            var dataBUTTON="";
	            if(doc.isenable==1){
	            	dataBUTTON="<button class=\"border-r4 search-uses fr_right f_show\" target=\"#start-in\" fun_method=\"start_card('"+doc.id+"','"+doc.realname+"')\">启用帐号</button>";
	            } else if(doc.isenable==0){
	            	dataBUTTON="<button class=\"border-r4 search-uses fr_right f_show\" target=\"#start-out\" fun_method=\"stop_card('"+doc.id+"','"+doc.realname+"')\">停用帐号</button>";
	            }
	            dataBUTTON=dataBUTTON+"<button class=\"border-r4 search-uses fr_right f_show\" target=\"#rest-password\" fun_method=\"res_pass('"+doc.id+"','"+doc.realname+"')\">重置密码</button>";
	            
	            dataBUTTON=dataBUTTON+"<div class=\"border-r4 search-uses fr_right\"><a href=\"${webroot}/doctor/edit?id="+doc.id+"\">修改信息</a></div>";
	            
	            dataDIV=dataDIV+dataBUTTON+"</div>";
	          
	          	dataTRs=dataTRs+dataDIV+"</td></tr>";
	          	
	          	dataTRs0=dataTRs0+dataTRs;
			}
			
			//更新html数据块
			$("#datagrid").html("");
			
			$("#datagrid").html(dataTRs0);
			$(".f_show").unbind("click");
			$(".f_hide").unbind("click");
			//显示弹出框
			$(".f_show").click(show);
			//隐藏弹出框
			$(".f_hide").click(hide);
			oTable();
		}
	});
}
function sortDepartment(department){
	if(sortFlag==0){
		sortFlag = 1;
	}else if(sortFlag==1){
		sortFlag = 0;	
	}
	sortName = department;
	queryPageForJSON();
}
$(function(){
	$("#nav").find("li").eq(0).addClass("change");
	$("#doctor").find("li").eq(1).addClass("n_on");
});
</script>
</head>

<body style="background-color: #eef7fe;" >
        <!--nav-等待问题菜单-结束-->
        <div class="all">
            <div class="s20"></div>
            <div class="search-management">
                <div class="invitation fl_left">管理医生：</div>
            </div>
            <div class="s10" style="clear:both;"></div>
            <form action="${webroot }/doctor/listAll" method="post" >
            <div  class="all-password">
                 <div class="business">
                  <div class="business-hos fl_left">
                    <div class="business-yy fl_left">
                            <label class="business-cont fl_left">关键字：</label>
                            <div class="businessr-wi">
                              <input type="text" id="realnameExc" name="realname" class="all-doctorrr"  placeholder="医生名" value="${doctor.realname }">
                            </div>
                     </div>
                     <div class="s10"  style="clear:both;"></div>
                     <div class="businessr-item">
                     <div class="business-yy fl_left">
                            <label class="business-cont fl_left">医院：</label>
                            <div class="businessr-wi">
                              <div class="business-drop fl_left">
                                  <select id="hospitalExc" name="hospitalId" class="select_hight">
	                            	<option value="">--所有医院--</option>
	                            	<c:forEach var="crb" items="${hospitalList}">
					   				<option value="${crb.id}" <c:if test="${doctor.hospitalId eq crb.id}">selected="selected"</c:if> >${crb.hospitalName}</option>
					    		</c:forEach>
	                            </select>
                              </div>
                            </div>  
                     </div>
                     <div class="business-yy fl_left">
                            <label class="business-cont fl_left">科室：</label>
                            <div class="businessr-wi">
                              <div class="business-drop fl_left">
                                  <select id="departmentExc" name="department" class="select_hight">
	                            	<option value="">--所有科室--</option>
	                            	<c:forEach var="crb" items="${departmentList}">
						   				<option value="${crb}" <c:if test="${doctor.department eq crb}">selected="selected"</c:if> >${crb}</option>
						    		</c:forEach>
	                            </select>
                              </div>
                            </div>  
                     </div>
                    </div>
                  </div>
                  <button class="businessr-y border-r4 fr_right" onclick="javascript:window.location.href='search.html';">查  询</button>
                </div>
                </form>
                <div class="businessr-export" style="clear:both;">
                  <div class="business">
                     <div class="export fl_left">${pagemodel.total}个结果&nbsp;&nbsp;&nbsp;&nbsp;每页${pagemodel.limit}条</div>
                      <a href='${webroot }/doctor/excel_doctor?realname=${doctor.realname}&hospital=${doctor.hospital}&department=${docotr.department}' target="_blank">
                     	<c:if test="${not empty pagemodel.results}">
                     		<div class="export-dc border-r4 fr_right">导出Excel</div>
                     	</c:if>
                     </a>
                     <c:if test="${empty pagemodel.results}">
                     	<div class="export-dc border-r4 fr_right" onclick="importNotExcel()">导出Excel</div>
                     </c:if>
                     <div class="export fr_right">
                     	<c:if test="${empty doctor.hospitalId }">
                     		"所有医院" +
                     	</c:if>
                     	<c:if test="${not empty doctor.hospitalId }">
                     		<c:forEach var="crb" items="${hospitalList}">
                     			<c:if test="${doctor.hospitalId == crb.id }">
                     				"${crb.hospitalName }" +
                     			</c:if>
                     		</c:forEach>
                     		
                     	</c:if>
                     	<c:if test="${empty doctor.department }">
                     		"所有科室"
                     	</c:if>
                     	<c:if test="${not empty doctor.department }">
                     		"${doctor.department }"
                     	</c:if>
                     </div>
                  </div>
                </div>
            </div>
            <div class="alldoctors">
               <table width="1230" border="0" style="clear:both; margin:0 auto;height: auto;">
                  <tr style="border:none;">
                      <th width="100">编号
                      	<div class="sort" title="点击排序">
		                        <span onclick="sortDepartment('id');">
		                        	<img src="${webroot }/common/images/arrow.png">
		                        </span>
	                        </div>
                      </th>
                      <th width="3"><img src="${webroot }/common/images/vertical.png"></th>
                      <th width="140">姓名</th>
                      <th width="3"><img src="${webroot }/common/images/vertical.png"></th>
                      <th width="160">科室
	                        <div class="sort" title="点击排序">
		                        <span onclick="sortDepartment('department');">
		                        	<img src="${webroot }/common/images/arrow.png">
		                        </span>
	                        </div>
                      </th>
                      <th width="3"><img src="${webroot }/common/images/vertical.png"></th>
                      <th width="160">所属医院
	                        <div class="sort" title="点击排序">
		                        <span onclick="sortDepartment('hospitalId');">
		                        	<img src="${webroot }/common/images/arrow.png">
		                        </span>
	                        </div>
                      </th>
                      <th width="3"><img src="${webroot }/common/images/vertical.png"></th>
                      <th width="160">联系电话</th>
                      <th width="3"><img src="${webroot }/common/images/vertical.png"></th>
                      <th width="90">邀请码</th>
                      <th width="3"><img src="${webroot }/common/images/vertical.png"></th>
                      <th>操作</th>
                    </tr>
                   </table>
                    <div id="doctor_div" style="width:1252px; height:540px;position:absolute;">
                    <table id="datagrid" width="auto" height="200" border="0" style="clear:both; margin:0 auto;height: auto;">
                    <c:forEach items="${pagemodel.results}" var="doc">
	                    <tr>
	                      <td width="100" height="27">${doc.id}</td>
	                      <td width="3"></td>
	                      <td width="140">${doc.realname}</td>
	                      <td width="3"></td>
	                      <td width="160">${doc.department}</td>
	                      <td width="3"></td>
	                      <td width="160">${doc.hospital}</td>
	                      <td width="3"></td>
	                      <td width="160">${doc.mobilephone}</td>
	                      <td width="3"></td>
	                      <td width="90">${doc.invitecode}</td>
	                      <td width="3"></td>
	                      <td>
	                       <div class="search-other fr_right">
	                       	<c:if test="${doc.isenable==1 }">
	                         	<button class="border-r4 search-uses fr_right f_show" onclick="openEnableUser('0','${doc.id }','${doc.realname }')"  fun_method="start_card('${doc.id }','${doc.realname }')">启用帐号</button>
	                        </c:if>
	                        <c:if test="${doc.isenable==0 }">
	                          <button class="border-r4 search-uses fr_right f_show" onclick="openEnableUser('1','${doc.id }','${doc.realname }')" fun_method="stop_card('${doc.id }','${doc.realname }')">停用帐号</button>
	                        </c:if>
	                          <button class="border-r4 search-uses fr_right f_show" onclick="openRestPass('${doc.realname }')" fun_method="res_pass('${doc.id }','${doc.realname }')">重置密码</button>
	                          <div class="border-r4 search-uses fr_right"><a href="${webroot}/doctor/edit?id=${doc.id}">修改信息</a></div>
	                        </div>
	                      </td>
	                    </tr>
                    </c:forEach>
                    <c:if test="${empty pagemodel.results}">
                    	<div class="search-mod" style="clear:both;" align="center">查询无结果</div>
                    </c:if>
                    </table>
                    </div>
               <div class="s140"></div>
               <div class="search-bb">
               <!-- 分页页面引入 -->
               <%@ include file="/WEB-INF/views/pager.jsp" %>
               </div>
               <div class="s20" style="clear:both;"></div>
               <div class="alldoctorsimg"></div>
            </div>
            </div>
     </div>
<!--停用医生账号弹出层-->
<div class="modal fade" id="start-out" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog " role="document">
    <div class="modal-content startout">
      <div class="modal-header startout-top" style="padding: 5px 12px;border: none;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title1">停用医生帐</h4>
      </div>
      <div class="modal-body task-anapply">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="control-label startout-content">
			              您要停用  <span class="dor_stop_out"></span> 医生的帐号。<br/>
			              停用帐号后医生将不再能登录和问诊，确认要停用帐号么？
			              <input type="hidden" class="dor_stop_out_value">
            </label>
          </div>
        </form>
      </div>
      <div class="modal-footer te_cent task-applyy">
        <button type="button" class="border-r4 task-anapp fl_left task-fl-button f_hide" target="#start-out" fun_method="cancel_fun">取消</button>
        <button type="button" class="border-r4 task-anapply fr_right task-fr-button task-primary  f_true" id="btn_trueStart"  target="#start-out"  fun_method="true_fun('1')">确认</button>
      </div>
    </div>
  </div>
</div><!-- End 使用医生账号弹出层结束 -->

<!--启用账号弹出层-->
<div class="modal fade" id="start-in" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog " role="document">
    <div class="modal-content startout">
      <div class="modal-header startout-top" style="padding: 5px 12px;border: none;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title1">启用医生帐号</h4>
      </div>
      <div class="modal-body task-anapply">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="control-label startout-content">
			              您要启用  <span class="dor_start_in"></span> 医生的帐号。<br/>
			               <input type="hidden" class="dor_start_in_value">
            </label>
          </div>
        </form>
      </div>
      <div class="modal-footer te_cent task-applyy">
        <button type="button" class="border-r4 task-anapp fl_left task-fl-button  f_hide"  target="#start-in" fun_method="cancel_fun">取消</button>
        <button type="button" class="border-r4 task-anapply fr_right task-fr-button task-primary f_true" id="btn_trueStart" target="#start-in" fun_method="start_in(0)">确认</button>
      </div>
    </div>
  </div>
</div><!-- End 启用账号弹出层结束 -->

<!--重置密码弹出层-->
<div class="modal fade" id="rest-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog " role="document">
    <div class="modal-content startout">
      <div class="modal-header startout-top" style="padding: 5px 12px;border: none;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title1">重置密码</h4>
      </div>
      <div class="modal-body task-anapply">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="control-label startout-content">
              您要重置  <span class="dor_rest_pass"></span> 医生的登录密码？
              <input type="hidden" class="dor_rest_pass_value">
            </label>
          </div>
        </form>
      </div>
      <div class="modal-footer te_cent task-applyy">
        <button type="button" class="border-r4 task-anapp fl_left task-fl-button f_hide" target="#rest-password">取消</button>
        <button type="button" class="border-r4 task-anapply fr_right task-fr-button task-primary f_true" id="btn_trueStart"  target="#rest-password" fun_method="rest_in()">确认</button>
      </div>
    </div>
  </div>
</div><!-- End 重置密码弹出层结束 -->




<script>
//导出Excel
function excelDoctor(){
	var realname = $("#realnameExc").val();
	var department = $("#departmentExc").val();
	var hospital = $("#hospitalExc").val();
	//window.location.href="${webroot }/doctor/excel_doctor?realname="+realname+"&department="+department"&hospital="+hospital;
	$.ajax({ 
		url: "${webroot }/doctor/excel_doctor", 
		type: "post", //数据发送方式 
		async : true,
		data: {realname:realname,department:department,hospital:hospital},
		dataType: "json", //接受数据格式 (这里有很多,常用的有html,xml,js,json) 
		error: function () {
			alert("网络超时，请稍后再试！");
		},
		success: function(data){ //成功
			alert(data);
			window.location.reload();
		} 
	});
}
function openRestPass(name){
	dialog(0,{title:"重置密码",body:" 您要重置  <font color=\"red\">"+name+"</font> 医生的登录密码？",btn_name1:"确认",btn_name2:"取消",trueFun:function(){rest_in()}});
}
function openEnableUser(status,id,name){
	if(status==0){
		dialog(0,{title:"启用医生帐号",body:" 您要启用  <font color=\"red\">"+name+"</font> 医生的帐号？",btn_name1:"确认",btn_name2:"取消",trueFun:function(){pubMethod(id,'0')}});
	}else{
		dialog(0,{title:"停用医生帐号",body:" 您要停用  <font color=\"red\">"+name+"</font> 医生的帐号？</br>停用帐号后医生将不再能登录和问诊，确认要停用帐号么？",btn_name1:"确认",btn_name2:"取消",trueFun:function(){pubMethod(id,'1')}});
	}
}


//二级下拉菜单
  $(function(){
  $(".subNav").click(function(){
    $(this).next(".navContent").slideToggle(300).siblings(".navContent").slideUp(500);
  })  
})


//二级下拉菜单点击切换白色背景
 $(".nyrr li").click(function(){
  $(this).siblings().removeClass("n_on");
  $(this).addClass("n_on");
 }); 

 //科室
 $(".business-drop .businessr-menu").click(function(){
      if(!$(this).attr("flag")||$(this).attr("flag")=="1"){
         $(this).siblings("ul").show();
         $(this).attr("flag","0");
      }else{
         $(this).siblings("ul").hide();
         $(this).attr("flag","1");
      }
      
   });
  $(".business-drop li").click(function(){
      $(this).parent().siblings("div").html($(this).html());
      $(this).parent().hide();
      $(this).parent().siblings("div").attr("flag","1");
   });
  function show(){
		$($(this).attr("target")).modal('show');
		if($(this).attr("fun_method")){
			eval("("+$(this).attr("fun_method")+")");
		}
	}
	function hide(){
		$($(this).attr("target")).modal('show');
		if($(this).attr("fun_method") && window[$(this).attr("fun_method")]){
			eval("("+$(this).attr("fun_method")+")");
		}else{
			$($(this).attr("target")).modal('hide');
		}
	}
	//显示弹出框
	$(".f_show").click(show);
	//隐藏弹出框
	$(".f_hide").click(hide);
  
  
  //显示弹出框
	$(".f_show").click(function(){
		$($(this).attr("target")).modal('show');
		if($(this).attr("fun_method")){
			eval("("+$(this).attr("fun_method")+")");
		}
	});
	//隐藏弹出框
	$(".f_hide").click(function(){
		$($(this).attr("target")).modal('hide');
		if($(this).attr("fun_method")){
			eval("("+$(this).attr("fun_method")+")");
		}
	});
	//隐藏弹出框
	$(".f_true").click(function(){
		$($(this).attr("target")).modal('hide');
		if($(this).attr("fun_method")){
			eval("("+$(this).attr("fun_method")+")");
		}
	});
	//停用医生
	function stop_card(id,name){
		$(".dor_stop_out").html(name);
		$(".dor_stop_out_value").val(id);
	}
	//停用医生--确定
	function true_fun(isEnable){
		var id = $(".dor_stop_out_value").val();
		var isEnable = isEnable;
		pubMethod(id,isEnable);
		
	}
	//启用医生
	function start_card(id,name){
		$(".dor_start_in").html(name);
		$(".dor_start_in_value").val(id);
	}
	//启用医生--确定
	function start_in(isEnable){
		var id = $(".dor_start_in_value").val();
		var isEnable = isEnable;
		pubMethod(id,isEnable);
	}
	//重置密码
	function res_pass(id,name){
		$(".dor_rest_pass").html(name);
		$(".dor_rest_pass_value").val(id);
	}
	//重置密码--确定
	function rest_in(){
		var id = $(".dor_rest_pass_value").val();
		$.ajax({ 
			url: "${webroot }/doctor/restpassword", 
			type: "post", //数据发送方式 
			async : true,
			data: {id:id},
			dataType: "json", //接受数据格式 (这里有很多,常用的有html,xml,js,json) 
			error: function () {
				alert("网络超时，请稍后再试！");
			},
			success: function(data){ //成功
				if(data["status"] == 0){
					alert(data["msg"]);
				}else{
					alert(data["msg"]);
				}
				window.location.reload();
			} 
		});
	}
	//ajax修改状态共用方法
	function pubMethod(id,isEnable){
		$.ajax({ 
			url: "${webroot }/doctor/updateDoctorStatus", 
			type: "post", //数据发送方式 
			async : true,
			data: {id:id,isenable:isEnable},
			dataType: "json", //接受数据格式 (这里有很多,常用的有html,xml,js,json) 
			error: function () {
				alert("网络超时，请稍后再试！");
			},
			success: function(data){ //成功
				if(data > 0){
					alert("修改成功！");
				}else{
					alert("修改失败！");
				}
				window.location.reload();
			} 
		});
	}
	function importNotExcel(){
		alert("数据为空，不能使用导出功能！");
		return;
	}
	$("#doctor_div").mCustomScrollbar({theme:"dark-thick"});
</script>
</body>

</html>