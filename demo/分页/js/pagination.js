//总页数，后台传
var pageConfig = {totalPage:30}

$(document).ready(function() {
	curPage = "";
	updatePageOffsetList();
});

//尾页
function lastPage() {
	var end = pageConfig.totalPage;
	goPage(end);
}

//页码跳转
function goPage(newOffset) {
	//console.info(newOffset);
	curPage = newOffset;
	//向后台请求数据方法
	//queryPageForJSON();
	
	//更新页码列表
	updatePageOffsetList();
}

//更新页码列表
function updatePageOffsetList() {
	var pagenumberLI = "<ul>";
	//页码列表,默认显示9个页面页码
	//根据当前页码左右补全
	//左补全
	var totalPage = pageConfig.totalPage;
	if(!curPage){
		curPage = Math.ceil(totalPage / 2);
	}
	var start = 1;
	var end = pageConfig.totalPage;
	for (var i = 4; i >= 1; i--) {
		if ((curPage - i) >= 1) {
			start = curPage - i;
			break;
		}
	}

	for (var i = 4; i >= 1; i--) {
		if ((curPage + i) <= totalPage) {
			end = curPage + i;
			break;
		}
	}

	//如果小于9则右侧补齐
	if (end - start + 1 <= 9) {
		var padLen = 9 - (end - start + 1);
		for (var i = padLen; i >= 1; i--) {
			if ((end + i) <= totalPage) {
				end = end + i;
				break;
			}
		}
	}

	//如果还小于9左侧补齐
	if (end - start + 1 <= 9) {
		var padLen = 9 - (end - start + 1);
		for (var i = padLen; i >= 1; i--) {
			if ((start - i) >= 1) {
				start = start - i;
				break;
			}
		}
	}

	if (curPage > 1) { //有上一页
		$('#firstpage').removeAttr("disabled");
	} else {
		$('#firstpage').prop('disabled', "true");
	}

	for (var i = start; i <= end; i++) {
		if (curPage == i) { //当前页
			pagenumberLI = pagenumberLI + "<li class=\"border-r4 pitchon\" onclick=\"javascript:goPage(" + i + ");\">" + i + "</li>";
		} else {
			pagenumberLI = pagenumberLI + "<li class=\"border-r4\" onclick=\"javascript:goPage(" + i + ");\">" + i + "</li>";
		}
	}
	if (curPage < totalPage) { //有下一页
		$('#lastpage').removeAttr("disabled");
	} else {
		$('#lastpage').prop('disabled', "true");
	}

	$("#pagenumber").html(""); //页码列表清空
	pagenumberLI += "<li style=\"width:50px\" class=\"border-r4\">" + curPage+"/"+totalPage + "</li>";;
	$("#pagenumber").html(pagenumberLI + "</ul>");
}