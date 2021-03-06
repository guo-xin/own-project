<?php
use yii\helpers\Url;
?>
<?php $this->beginPage() ?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="description" content="览海在线健康管理有限公司是国内率先专注于“移动智慧医疗”服务的新型O2O高新技术企业，自主完成软硬件产品开发、生产、销售的新型互联网企业，依托于线下国际连锁私立医疗和体检机构的优质医疗资源，以及新型的互联网健康商业保险相结合，探索医疗产业线上线下相结合，以及金融和产业相结合，智能穿戴医疗硬件和云服务相结合的产业化应用研究先行者之一。" />
    <meta name="keywords" content="览海在线健康,上海览海在线,览海健康管理,览海在线,我有医生,健康管理,健康,医疗,移动" />
    <meta name="viewport" content="height = device-height ,width = device-width ,initial-scale = 1.0,minimum-scale = 1.0,maximum-scale = 1.0,user-scalable = no" />
    <title>我有医生</title>
    <link href="/css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link href="/css/common_wap.css" type="text/css" rel="stylesheet">
    <?php if (Yii::$app->controller->id == 'index'):?>
    <link href="/css/wap.css" type="text/css" rel="stylesheet">
    <?php endif;?>
    <script type="text/javascript" src="/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/public.js"></script>
</head>
<?php $this->beginBody() ?>
<?php if (Yii::$app->controller->id == 'index'):?>
<body>
<?php else: ?>
<body class="bg-gray">
<?php endif;?>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"><img src="http://img1.healthdoc.cn/c/51/3e/513e66b805d245be355833b00b35b161.png" alt=""><span>我有医生</span></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li <?php if (Yii::$app->controller->id == 'index') {echo 'class="active"';}?>>
                    <a href="/">首页</a>
                </li>
                <li <?php if (Yii::$app->controller->id == 'user') {echo 'class="active"';}?>>
                    <a href="<?php echo Url::to('/user/signup')?>">免费问诊</a>
                </li>
                <li <?php if (Yii::$app->controller->id == 'invite') {echo 'class="active"';}?>>
                    <a href="<?php echo Url::to('/invite/begin')?>">患者报到</a>
                </li>
                <li <?php if (Yii::$app->controller->id == 'enterprise') {echo 'class="active"';}?>>
                    <a href="<?php echo Url::to('/enterprise/index')?>">企业专享</a>
                </li>
            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
</nav>
<?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>