            <div class="slider-page">
                <div style="padding-top: 80px;">
                    <div class="login">
                        <!--注册成功-->
                        <div class="web_register web">
                            <div class="register_form">
                                <h3 class="textcenter"><img src="http://img1.healthdoc.cn/c/14294b177f186027da3c88c59738f565.png"/>注册成功</h3>
<?php if ($pkgNames): ?>
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
<?php endif;?>
                                <p><img src="http://img1.healthdoc.cn/c/e58553a0fd49260fc56e6ebd4cb7f898.png" /></p>
                                <h4 class="textcenter" style="margin-top: 25px;">下载我有医生APP</h4>
                                <h4 class="textcenter" style="color: #aaaaaa;">即刻享用在线问诊服务</h4>
                            </div>
                        </div>
                        <!--注册end-->
                    </div>
                </div>
                <!--备案-->
            <?php echo $this->render('/layouts/webPageFooter');?>
            </div>