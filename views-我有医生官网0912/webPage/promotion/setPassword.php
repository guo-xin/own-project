<?php 
use yii\helpers\Url;

?>
            <div class="slider-page">
                <div style="padding-top: 80px;">
                    <div class="login">
                        <div class="header">
                            <div class="switch">
                                <h3 class="textcenter">邀请注册</h3>
                            </div>
                        </div>
                        <!--注册-->
                        <div class="web_register web">
                            <div class="register_form">
                                <form action="" name="registerform" accept-charset="utf-8" id="register_form" method="post">
                                    <div class="col-xs-5 login-div" style="padding-bottom: 0px;">
                                        <h4 class="f16">设置登录密码:</h4>
                                    </div>
                                    <div class="col-xs-5 login-div">
                                        <input type="password" name="tel" class="form-control inputstyle" placeholder="请设置登录密码" />
                                        <div class="index-error"></div>
                                    </div>
                                    <div class="col-xs-5 login-div">
                                        <input type="password" name="yzh" class="form-control inputstyle" placeholder="请再次输入确认" />
                                        <div id="logError" class="index-error"></div>
                                    </div>
                                    <div class="col-xs-5 login-div">
                                        <input type="button" href="javascript:void(0);" class="btn btn-color next-step" value="确定" onclick="register();" />
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--注册end-->
                    </div>
                </div>
                <!--备案-->
            <?php echo $this->render('/layouts/webPageFooter');?>
            </div>
            <script type="text/javascript">
                /*输入密码完成*/
                function register() {
                    var t = $(".web_register").find("input[name=tel]");
                    var c = $(".web_register").find("input[name=yzh]");
                    if(isNull(t, "密码") == true && isNull(c, "验证密码") == true && t.val() == c.val()){
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
                                window.location = "<?php echo Url::to('/promotion/result')?>";
                            } else {
                                $("#logError").html(data.desc);
                                $("#logError").show();
                            }
                        },
                        error : function() {
                            $("#logError").html("请求失败，请稍后重试");
                            $("#logError").show();
                        }
                    })
                    }else if(isNull(t, "密码") == true && isNull(c, "验证密码") == true && t.val() !== c.val()){
                        $("#logError").html("密码与确认密码不一致");
                    }
                }
            </script>
