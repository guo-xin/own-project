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
                        <div class="col-xs-6 login-div">
                            <h4 class="f16">请输入医生邀请码，兑换你的免费权限:</h4>
                            <input type="text" name="yqm" class="form-control inputstyle" placeholder="请输入医生邀请码" />
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
            var t = $(".web_register").find("input[name=yqm]");
            if (isNull(t, "邀请码") == true) {
                $.ajax({
                    type : "post",
                    url : "<?php echo Url::to('/invite/verify-invite-code'); ?>",
                    data : {
                        code : t.val()
                    },
                    async : false,
                    cache : false,
                    dataType : "json",
                    success : function(data) {
                        if (data.code == 0) {
                            window.location.href = "<?php echo Url::to('/invite/next')?>";
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
</div>