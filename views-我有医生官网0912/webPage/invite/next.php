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
                            <input type="text" name="tel" class="form-control inputstyle" placeholder="请输入手机号码!" />
                            <div class="index-error"></div>
                        </div>
                        <div class="col-xs-6 login-div1">
                            <input type="text" name="yzh" class="form-control inputstyle" style="width: 65%;display: inline;" placeholder="请填入您手机收到的验证码" />
                            <input type="button" href="javascript:void(0);" class="btn btn-color get" onclick="getPIN(this);" value="获取验证码" />
                            <div class="index-error"></div>
                        </div>
                        <div class="col-xs-6 login-div checkbox-img">
                            <a class="unchecked checked"></a>
                            <input type="checkbox" checked="checked" />
                            <span><a href="<?php echo Url::to('/user/registeragreement')?>" target="_blank">我同意《用户注册协议》</a></span>
                            <div id="logError" class="index-error"></div>
                        </div>
                        <div class="col-xs-6 login-div">
                            <input type="button" href="javascript:void(0);" class="btn btn-color next-step" value="下一步" onclick="register();" />
                        </div>
                    </form>
                </div>
            </div>
            <!--注册end-->
        </div>
    </div>
    <?php echo $this->render('/layouts/webPageFooter');?>
    <script type="text/javascript">
        function getPIN(val) {
            var t = $(".web_register").find("input[name=tel]");
            if (isTel(t) == true){
                $.ajax({
                    type : "post",
                    url : "<?php echo Url::to('/common/get-verify-code')?>",
                    data : {
                        mobileNum : t.val(),
                    },
                    async : false,
                    cache : false,
                    dataType : "json",
                    success : function(data) {
                        if (data.code == 0) {
                            countTime(val);
                        }else{
                            $("#logError").html(data.desc);
                            $("#logError").show();
                        }
                    },
                    error : function() {
                        $("#logError").html("请求失败，请稍后重试");
                        $("#logError").show();
                    }
                });
            }
        }
        /*注册下一步*/
        function register() {
            var t = $(".web_register").find("input[name=tel]");
            var c = $(".web_register").find("input[name=yzh]");
            if (isTel(t) == true && isNull(c, "验证码") == true) {
                $.ajax({
                    type : "post",
                    url : "<?php echo Url::to('/invite/register')?>",
                    data : {
                        mobileNum : t.val(),
                        authCode : c.val()
                    },
                    async : false,
                    cache : false,
                    dataType : "json",
                    success : function(data) {
                        if (data.code == 0) {
                            window.location = "<?php echo Url::to('/invite/password')?>";
                        } else{
                            $("#logError").html(data.desc);
                            $("#logError").show();
                        }
                    },
                    error : function() {
                        $("#logError").html("请求失败，请稍后重试");
                        $("#logError").show();
                    }
                })
            }
        }
    </script>
    </div>