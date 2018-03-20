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
                                    <div class="col-xs-12 login-div">
                                        <h4 class="f16">输入4位数邀请码:</h4>
                                        <input type="text" value='<?php echo $promotionCode;?>' name="yqm" class="form-control inputstyle" placeholder="请输入邀请码" />
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
                /*注册下一步*/
                function register() {
                    var t = $(".web_register").find("input[name=yqm]");
                    if (isNull(t, "邀请码") == true) {
                        $.ajax({
                            type : "post",
                            url : "<?php echo Url::to('/promotion/index'); ?>",
                            data : {
                                code : t.val()
                            },
                            async : false,
                            cache : false,
                            dataType : "json",
                            success : function(data) {
                                if (data.code == 0) {
                                    window.location.href = "<?php echo Url::to('/promotion/register')?>";
                                } else{
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
