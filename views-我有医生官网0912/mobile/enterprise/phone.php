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
                        <input type="text" style="display: none;" />
                        <div class="col-xs-12 login-div">
                            <h4 class="f16">将服务绑定到手机:</h4>
                            <input type="text" name="tel" class="form-control inputstyle" placeholder="请输入手机号码" />
                        </div>
                        <div class="col-xs-12 login-div">
                            <input type="button" href="javascript:void(0);" class="btn btn-color next-step" value="下一步" onclick="register();" />
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
    /*注册下一步*/
    function register() {
        var t = $(".web_register").find("input[name=tel]");
        if (isTel(t) == true) {
            $.ajax({
                type : "post",
                url : "<?php echo Url::to('/enterprise/next')?>",
                data : {
                    tel : t.val(),
                },
                async : false,
                cache : false,
                dataType : "json",
                success : function(data) {
                    if (data.code == 0) {
                        window.location = "<?php echo Url::to('/enterprise/verify-password')?>";
                    } else if (data.code == 4) {
                        window.location = data.url;
                    } else {
                        mobileError(data.desc);
                    }
                },
                error : function() {
                    mobileError("请求失败，请稍后重试");
                }
            });
        }
    }
</script>