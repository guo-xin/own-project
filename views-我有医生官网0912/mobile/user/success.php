<div class="sliderm-page">
    <div style="margin-top: 30px;">
        <div class="login">
            <!--注册成功-->
            <div class="web_register web">
                <div class="register_form">
                    <img class="success-img" src="http://img1.healthdoc.cn/c/43/34/4334a4f0c8417a4c82e5f3ed1ea7a963.png" />
                    <h2 class="textcenter success">注册成功</h2>
                    <h4 class="textcenter" style="margin-top: 25px;">
                    <?php
                        $arr = array_map(function ($value){
                            if($value == 'testtesttest'){
                                return ;
                            }else{
                                return "\"{$value}\"";
                            }
                        }, $pkgNames);
                        $str = implode(' ', $arr);
                        if(empty($str)){
                            echo $str;
                        }else{
                            echo '恭喜您获得'.$str;
                        }
                    ?>
                    </h4>
                    <div class="mobile-down">
                        <a href="/">下载我有医生APP</a>
                    </div>
                    <h4 class="textcenter" style="color: #aaaaaa;">即刻享用在线问诊服务</h4>
                </div>
            </div>
            <!--注册end-->
        </div>
    </div>
</div>
<?php echo $this->render('/layouts/mobileFooter');?>
