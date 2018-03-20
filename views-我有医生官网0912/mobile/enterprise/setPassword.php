<?php 
use yii\helpers\Url;
?>
<div class="sliderm-page">
    <div style="margin-top: 30px;">
        <div class="login">
            <div class="header">
                <div class="switch">
                    <h2 class="textcenter">企业专享</h2>
                </div>
                <!--手机版错误信息提示语-->
                <div class="col-xs-12 login-div">
                    <div class="index-error"></div>
                </div>
            </div>
            <!--注册-->
            <div class="web_register web">
                <div class="register_form">
                    <form action="" name="registerform" accept-charset="utf-8" id="register_form" method="post">
                        <div class="col-xs-12 login-div" style="padding-bottom: 0px;">
                            <h4 class="f16">设置服务密码:</h4>
                        </div>
                        <div class="col-xs-12 login-div">
                            <input type="password" name="tel" class="form-control inputstyle" placeholder="请设置服务密码" />
                        </div>
                        <div class="col-xs-12 login-div">
                            <input type="password" name="yzh" class="form-control inputstyle" placeholder="请再次输入确认" />
                        </div>
                        <div class="col-xs-12 login-div">
                            <input type="button" href="javascript:void(0);" class="btn btn-color next-step" value="绑定" onclick="register();" />
                        </div>
                    </form>
                </div>
            </div>
            <!--注册end-->
        </div>
    </div>
</div>
<?php echo $this->render('/layouts/mobileFooter');?>
<script type="text/javascript">
/*输入密码完成*/
function register() {
    var t = $(".web_register").find("input[name=tel]");
    var c = $(".web_register").find("input[name=yzh]");
    if (isNull(t, "密码") == true && isNull(c, "验证密码") == true && t.val() == c.val()) {
        $.ajax({
            type : "post",
            url : "<?php echo Url::to('set-password')?>",
            data : {
                password : t.val(),
            },
            async : false,
            cache : false,
            dataType : "json",
            success : function(data) {
                if (data.code == 0) {
                    window.location = "<?php echo Url::to('/enterprise/result')?>";
                } else {
                    mobileError(data.desc);
                }
            },
            error : function() {
                mobileError("请求失败，请稍后重试");
            }
        })
    } else if (isNull(t, "密码") == true && isNull(c, "验证密码") == true && t.val() !== c.val()) {
        mobileError("密码与确认密码不一致");
    }
}
</script>