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
                        <div class="col-xs-12 login-div1">
                            <h4 class="f16">验证手机号:</h4>
                            <input type="text" name="yzh" class="form-control inputstyle input-yz" placeholder="请填入您手机收到的验证码" />
                            <input type="button" href="javascript:void(0);" class="btn btn-color get" onclick="getPIN(this);" value="获取验证码" />
                        </div>
                        <div class="col-xs-12 login-div checkbox-img">
                            <a class="unchecked checked"></a>
                            <input type="checkbox" checked="checked" />
                            <span><a href="<?php echo Url::to('/user/registeragreement')?>" target="_self">我同意《用户服务协议》</a></span>
                        </div>
                        <div class="col-xs-12 login-div">
                            <input type="button" href="javascript:void(0);" class="btn btn-color next-step" value="验证" onclick="register();" />
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
/*注册获取验证码*/
var countdown = 60;
function countTime(count) {
    if (countdown == 0) {
        count.removeAttribute("disabled");
        $(count).removeClass("hover");
        count.value = "获取验证码";
        countdown = 60;
    } else {
        count.setAttribute("disabled", true);
        $(count).addClass("hover");
        count.value = "已发送(" + countdown + ")";
        countdown--;
        setTimeout(function() {
            countTime(count);
        }, 1000);
    }
}
function getPIN(val) {
    $.ajax({
        type : "post",
        url : "<?php echo Url::to('/common/get-verify-code')?>",
        data : {
            mobileNum : <?php echo $tel;?>,
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
    })
}
/*注册下一步*/
function register() {
    var c = $(".web_register").find("input[name=yzh]");
    if (isNull(c, "验证码") == true) {
        $.ajax({
            type : "post",
            url : "<?php echo Url::to('verify-code')?>",
            data : {
                code : c.val(),
            },
            async : false,
            cache : false,
            dataType : "json",
            success : function(data) {
                if (data.code == 0) {
                    window.location = "<?php echo Url::to('/enterprise/set-password')?>";
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