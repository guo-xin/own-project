$(function() {
	if (document.documentElement.clientHeight !== 0) {
		var height = document.documentElement.clientHeight;
	} else {
		var height = document.body.clientHeight;
	}
	$("body>div").css("height", height);
	$(".list-border>li").mouseenter(function() {
			var a = $(this).find("a").clone();
			a.appendTo($(".big-img"));
			var top = $(this).offset().top - 30 > 0 ? $(this).offset().top - 30 : 0;
			if ($(this).offset().top + 375 < height) {
				$(".big-img").css({
					"top": top,
					"right": $(".report-right").width() + 15
				}).show();
			} else {
				$(".big-img").css({
					"top": height - 405,
					"right": $(".report-right").width() + 15
				}).show();
			}
		}).mouseleave(function() {
			$(".big-img").empty().hide();
		})
		/*颜色拾取器*/
	$('.colorpicker0').ColorPicker({
			onSubmit: function(hsb, hex, rgb, el) {
				$(el).val(hex);
				$(el).css('background-color', '#' + hex);
				$(el).css('color', '#' + hex);
				$(el).ColorPickerHide();
			},
			onBeforeShow: function() {
				$(this).ColorPickerSetColor(this.value);
			}
		})
		.bind('keyup', function() {
			$(this).ColorPickerSetColor(this.value);
		});
})

function newCreat() {
	var html = "";
	html += "<fieldset disabled><h4 class='col-xs-offset-4 col-xs-8'><strong>配置</strong></h4><div class = 'form-group'><label class = 'col-xs-4 control-label'> 数据 </label><div class = 'col-xs-8'> <select class = 'form-control'>";
	html +="<option> 22 </option><option> 22 </option> <option> 22 </option></select></div></div><div class = 'form-group'><label class = 'col-xs-4 control-label'> 模板 </label > <div class = 'col-xs-8'> <select class = 'form-control'>";
	html +="<option> 22 </option> <option> 22 </option> <option> 22 </option></select ></div></div><div class = 'form-group'>";
	html +="<label class = 'col-xs-4 control-label'> 图型 </label> <div class = 'col-xs-8'> <select class = 'form-control'><option> 22 </option><option> 22 </option><option> 22 </option></select></div></div><div class = 'form-group'>";
	html +="<label class = 'col-xs-4 control-label'> 变量 </label><div class = 'col-xs-8'><select class = 'form-control'><option> 22 </option><option> 22 </option><option> 22 </option></select></div></div><div class = 'form-group'>";
	html +="<label class = 'col-xs-4 control-label'> 题目 </label><div class = 'col-xs-8'> <select class = 'form-control'><option> 22 </option><option> 22 </option><option> 22 </option></select></div></div><div class = 'btn btn-group col-xs-offset-3 col-xs-6'>";	
	html +="<button class = 'btn btn-primary btn-block' type = 'button'> 查看 </button></fieldset>";	
	$(".configure").html(html);	
	}