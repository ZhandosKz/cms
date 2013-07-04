<?php /* @var $this ModuleController */ ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<?php
$this->widget('bootstrap.widgets.TbNavbar', array(
    'brand' => 'Администрирование',
    'items' => array(
        '<p class="navbar-text pull-right">'.CHtml::link('Выйти', array('/user/logout'), array('class' => 'navbar-link')).'</p>',
        array(
            'class' => 'bootstrap.widgets.TbMenu',
            'items' => array(
                array('label'=>'Страницы', 'url'=>'/admin/content'),
                array('label'=>'Беседы', 'url'=>'/admin/interview'),
                array('label' => 'Галерея', 'url' => '/admin/gallery')
            )
        )
    )
));
?>
<div class="container-fluid">
    <?php
    $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
        'homeLink' => FALSE,
        'links'=>$this->breadcrumbs,
    ));
    ?>
    <div class="row-fluid">
        <div class="span2" style="padding-top: 20px;">
            <?php
            $this->widget('bootstrap.widgets.TbMenu', array(
                'type'=>'list',
                'items' => $this->leftMenu,
                'htmlOptions' => array(
                    'class' => 'well'
                )
            ));
            ?>
        </div>
        <div class="span10">
            <?=$content?>
        </div>
    </div>
</div>
<script type="text/javascript">
    var flashMessages = [];
    <?php foreach (Yii::app()->user->getFlashes() as $key => $message): ?>
        flashMessages.push({
            type: '<?=$key?>',
            text: '<?=$message?>'
        });
    <?php endforeach;?>
</script>
</body>
</html>
