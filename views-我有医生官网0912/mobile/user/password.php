<?php
    use yii\helpers\Url;
?>
<div class="sliderm-page">
    <div style="margin-top: 30px;">
        <div class="login">
            <div class="header">
                <div class="switch">
                    <h3 class="textcenter">新用户注册</h3>
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
                        <div class="col-xs-12 login-div">
                            <input type="password" name="tel" class="form-control inputstyle" placeholder="请设置登录密码" />
                        </div>
                        <div class="col-xs-12 login-div">
                            <input type="password" name="yzh" class="form-control inputstyle" placeholder="请再次输入确认" />
                        </div>
                        <div class="col-xs-12 login-div checkbox-img">
                            <a class="unchecked checked"></a>
                            <input type="checkbox" checked="checked" />
                            <span><a href="<?php echo Url::to('/user/registeragreement')?>" target="_self">我同意《用户注册协议》</a></span>
                        </div>
                        <div class="col-xs-12 login-div">
                            <input type="button" href="javascript:void(0);" class="btn btn-color next-step" value="完成	" onclick="register();" />
                        </div>
                    </form>
                </div>
            </div>
            <!--注册end-->
        </div>
    </div>
</div>
<?php echo $this->render('/layouts/mobileFooter');?>
<script>
    /*输入密码完成*/
    function register() {
        var t = $(".web_register").find("input[name=tel]");
        var c = $(".web_register").find("input[name=yzh]");
        if(isNull(t, "密码") == true && isNull(c, "验证密码") == true && t.val() == c.val()){
            $.ajax({
                type : "post",
                url : "<?php echo Url::to('/user/personal-password')?>",
                data : {
                    pwd : t.val(),
                    pwdAgain : c.val(),
                },
                async : false,
                cache : false,
                dataType : "json",
                success : function(data) {
                    if (data.code == 0) {
                        window.location = "<?php echo Url::to('/user/success')?>";
                    }else{
                        mobileError(data.desc);
                    }
                },
                error : function() {
                    mobileError("请求失败，请稍后重试");
                }
            })
        } else if(isNull(t, "密码") == true && isNull(c, "验证密码") == true && t.val() !== c.val()) {
            mobileError("密码与确认密码不一致");
        }
    }
</script>