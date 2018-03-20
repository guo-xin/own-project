<div class="slider-page">
    <div style="padding-top: 80px;">
        <div class="login">
            <!--注册成功-->
            <div class="web_register web">
                <div class="register_form">
                    <h3 class="textcenter success"><img src="http://img1.healthdoc.cn/c/43/34/4334a4f0c8417a4c82e5f3ed1ea7a963.png"/>绑定成功</h3>
                    <h4 class="textcenter" style="margin-top: 25px;">
                        恭喜您获得了
                        <?php
                        $arr = array_map(function ($value){
                            return "\"{$value}\"";
                        }, $pkgNames);
                        $str = implode(' ', $arr);
                        echo $str;
                        ?>
                    </h4>
                    <p><img src="http://img1.healthdoc.cn/c/d0/10/d010eb327868a60710b728e73f6056bf.png" /></p>
                    <h4 class="textcenter" style="margin-top: 25px;">下载我有医生APP</h4>
                    <h4 class="textcenter" style="color: #aaaaaa;">即刻享用在线问诊服务</h4>
                </div>
            </div>
            <!--注册end-->
        </div>
    </div>
</div>
<?php echo $this->render('/layouts/webPageFooter');?>