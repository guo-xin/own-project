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
                                    <input type="text" style="display: none;" />
                                    <div class="col-xs-5 login-div">
                                        <h4 class="f16">输入4位数邀请码:</h4>
                                        <input type="text" value='<?php echo $promotionCode;?>' name="yqm" class="form-control inputstyle" placeholder="请输入邀请码" />
                                        <div id="logError" class="index-error"></div>
                                    </div>
                                    <div class="col-xs-5 login-div">
                                        <input type="button" href="javascript:void(0);" class="btn btn-color next-step" value="下一步" onclick="register();" />
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
            </script>
