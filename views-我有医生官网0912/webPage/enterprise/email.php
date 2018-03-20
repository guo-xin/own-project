<?php 
use yii\helpers\Url;
?>
<div class="slider-page">
    <div style="padding-top: 80px;">
        <div class="login">
            <div class="header">
                <div class="switch">
                    <h3 class="textcenter">企业专享</h3>
                </div>
            </div>
            <!--注册-->
            <div class="web_register web">
                <div class="register_form">
                    <form action="" name="registerform" accept-charset="utf-8" id="register_form" method="post">
                        <input type="text" style="display: none;" />
                        <div class="col-xs-6 login-div">
                            <h4 class="f16">请输入您的邮箱账号，兑换免费权限:</h4>
                            <input type="text" name="mail" class="form-control inputstyle" placeholder="请输入邮箱账号" />
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
        /*注册下一步*/
        function register() {
            var t = $(".web_register").find("input[name=mail]");
            if (isMail(t) == true) {
                $.ajax({
                    type : "post",
                    url : "<?php echo Url::to('/enterprise/index')?>",
                    data : {
                        email : t.val(),
                    },
                    async : false,
                    cache : false,
                    dataType : "json",
                    success : function(data) {
                        if (data.code == 0) {
                            window.location = "<?php echo Url::to('/enterprise/next')?>";
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
            }

        }
    </script>
</div>