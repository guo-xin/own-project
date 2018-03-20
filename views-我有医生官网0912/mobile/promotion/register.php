<?php 
use yii\helpers\Url;
?>
            <div class="sliderm-page">
                <div style="margin-top: 50px;">
                    <div class="login">
                        <div class="header">
                            <div class="switch">
                                <h2 class="textcenter">邀请注册</h2>
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
                                        <h4 class="f16">注册“我有医生”APP帐号:</h4>
                                    </div>
                                    <div class="col-xs-12 login-div">
                                        <span class="web_phone"></span>
                                        <input type="text" name="tel" class="form-control inputstyle" placeholder="请输入手机号码" />
                                    </div>
                                    <div class="col-xs-12 login-div1">
                                        <input type="text" name="yzh" class="form-control inputstyle input-yz" placeholder="请输入验证码" />
                                        <input type="button" href="javascript:void(0);" class="btn btn-color get" onclick="getPIN(this);" value="获取验证码" />
                                    </div>
                                    <div class="col-xs-12 login-div checkbox-img">
                                        <a class="unchecked checked"></a>
                                        <input type="checkbox" checked="checked" />
                                        <span><a href="<?php echo Url::to('/user/registeragreement')?>" target="_self">我同意《用户注册协议》</a></span>
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
                <!--备案-->
<?php echo $this->render('/layouts/mobileFooter');?>
            </div>
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
                                    mobileError(data.desc);
                                }
                            },
                            error : function() {
                                mobileError("请求失败，请稍后重试");
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
                            url : "<?php echo Url::to('/promotion/register')?>",
                            data : {
                                mobileNum : t.val(),
                                authCode : c.val()
                            },
                            async : false,
                            cache : false,
                            dataType : "json",
                            success : function(data) {
                                if (data.code == 0) {
                                    window.location = "<?php echo Url::to('/promotion/set-password')?>";
                                } else {
                                    mobileError(data.desc);
                                }
                            },
                            error : function() {
                                mobileError("请求失败，请稍后重试");
                            }
                        })
                    }
                }
            </script>
