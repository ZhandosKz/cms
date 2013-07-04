<?php /* @var $this FrontendController */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<!--[if lt IE 8]>
	    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
	<title><?php echo Yii::app()->name.'.:.'.CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container">

    <div class="header">
        <div class="logo">
            <a href="/"><img src="/img/header/logo.png" alt="На главную" /></a>
        </div>
        <div class="caption">
            <span class="profession">Просто-сайт</span>
            <span class="name">Просто-сайт</span>
        </div>

    </div>
    <div class="menu">
        <ul>
            <?php foreach ($this->menu as $m):?>
                <li><?=CHtml::link($m['label'], $m['url'])?></li>
            <?php endforeach;?>
        </ul>
    </div>
    <div class="content">
        <?php if (!empty($this->pageTitle)):?>
            <h1><?=$this->pageTitle?></h1>
        <?php endif; ?>
        <?=$content?>
    </div>
    <div class="footer">
        <div class="inner">Просто сайт<br/>
            2013 г. Все права защищены.
        </div>
    </div>
</div>

</body>
</html>
