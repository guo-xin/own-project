<?php 
use yii\helpers\Url;
?>
<div class="slider-page">
    <div style="padding-top: 80px;">
        <div class="login">
            <div class="header">
                <div class="switch">
                    <h3 class="textcenter">患者报到</h3>
                </div>
            </div>
            <!--注册-->
            <div class="web_register web">
                <div class="register_form">
                    <form action="" name="registerform" accept-charset="utf-8" id="register_form" method="post">
                        <div class="col-xs-6 login-div" style="padding-bottom: 0px;">
                            <h4 class="f16">绑定"我有医生"APP账号领取服务:</h4>
                        </div>
                        <div class="col-xs-6 login-div">
                            <input type="password" name="tel" class="form-control inputstyle" placeholder="请设置登录密码" />
                            <div class="index-error"></div>
                        </div>
                        <div class="col-xs-6 login-div">
                            <input type="password" name="yzh" class="form-control inputstyle" placeholder="请再次输入确认" />
                            <div class="index-error"></div>
                        </div>
                        <div class="col-xs-6 login-div checkbox-img">
                            <a class="unchecked checked"></a>
                            <input type="checkbox" checked="checked" />
                            <span><a href="<?php echo Url::to('/user/registeragreement')?>" target="_blank">我同意《用户注册协议》</a></span>
                            <div id="logError" class="index-error"></div>
                        </div>
                        <div class="col-xs-6 login-div">
                            <input type="button" href="javascript:void(0);" class="btn btn-color next-step" value="绑定" onclick="register();" />
                        </div>
                    </form>
                </div>
            </div>
            <!--注册end-->
        </div>
    </div>
    <?php echo $this->render('/layouts/webPageFooter');?>
    <script type="text/javascript">
        /*输入密码完成*/
        function register() {
            var t = $(".web_register").find("input[name=tel]");
            var c = $(".web_register").find("input[name=yzh]");
            if(isNull(t, "密码") == true && isNull(c, "验证密码") == true && t.val() == c.val()){
                $.ajax({
                    type : "post",
                    url : "<?php echo Url::to('/invite/personal-password'); ?>",
                    data : {
                        pwd : t.val(),
                        pwdAgain : c.val(),
                    },
                    async : false,
                    cache : false,
                    dataType : "json",
                    success : function(data) {
                        if (data.code == 0) {
                            window.location = "<?php echo Url::to('/invite/success');?>";
                        } else {
                            $("#logError").html(data.desc);
                            $("#logError").show();
                        }
                    },
                    error : function() {
                        $("#logError").html("请求失败，请稍后重试");
                        $("#logError").show();
                    }
                });
            }else if(isNull(t, "密码") == true && isNull(c, "验证密码") == true && t.val() !== c.val()){
                $("#logError").html("密码与确认密码不一致");
            }
        }
    </script>
</div>