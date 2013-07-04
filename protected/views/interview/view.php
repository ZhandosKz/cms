<?php
/**
 * @var Interview $model
 * @var InterviewController $this
 */
?>
<?=$model->iframe?>
<?php if (!empty($model->text)):?>
    <h2>Описание видео</h2>
    <?=$model->text?>
<?php else: ?>
    <p><i>Описание видео отсутствует</i></p>
<?php endif; ?>