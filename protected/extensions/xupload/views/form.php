<!-- The file upload form used as target for the file upload widget -->
<?php if ($this->showForm) echo CHtml::beginForm($this -> url, 'post', $this -> htmlOptions);?>
<div class="row fileupload-buttonbar">
	<div class="span7">
		<!-- The fileinput-button span is used to style the file input field as button -->
		<span class="btn btn-success fileinput-button">
            <i class="icon-plus icon-white"></i>
            <span><?php echo $this->t('1#Add files|0#Choose file', $this->multiple); ?></span>
			<?php
            if ($this -> hasModel()) :
                echo CHtml::activeFileField($this -> model, $this -> attribute, $htmlOptions) . "\n";
            else :
                echo CHtml::fileField($name, $this -> value, $htmlOptions) . "\n";
            endif;
            ?>
		</span>
        <?php if ($this->multiple) { ?>
		<button type="submit" class="btn btn-primary start">
			<i class="icon-upload icon-white"></i>
			<span><?=$this->t('Start')?></span>
		</button>
		<button type="reset" class="btn btn-warning cancel">
			<i class="icon-ban-circle icon-white"></i>
			<span><?=$this->t('Cancel')?></span>
		</button>
		<button type="button" class="btn btn-danger delete">
			<i class="icon-trash icon-white"></i>
			<span><?=$this->t('Delete')?></span>
		</button>
		<input type="checkbox" class="toggle">
        <?php } ?>
	</div>
	<div class="span5">
		<!-- The global progress bar -->
		<div class="progress progress-success progress-striped active fade">
			<div class="bar" style="width:0%;"></div>
		</div>
	</div>
</div>
<!-- The loading indicator is shown during image processing -->
<div class="fileupload-loading"></div>
<br>
<!-- The table listing the files available for upload/download -->
<table class="table table-striped">
	<tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery">
        <?php foreach($availableFiles as $file): ?>
            <tr class="template-download fade in">
                <td class="preview">
                    <img src="/images/uploads/<?=$file->object_id?>/<?=$file->filename?>" style="height: 100px">
                </td>
                <td class="name"><?=$file->name?></td>
                <td class="size"><?=number_format($file->size / 1024, 2, '.', '')?> kb</td>
                <td class="description"><?=(!empty($file->description)) ? $file->description : 'Нет описания'?></td>
                <td colspan="2"></td>
                <td class="delete">
                    <button class="btn btn-danger" data-url="/admin/gallery/upload/_method/delete/file/<?=$file->getPrimaryKey()?>" data-type="POST">
                        <i class="icon-trash icon-white"></i>
                        <span><?=$this->t('Delete')?></span>
                    </button>
                    <input type="checkbox" value="1" name="delete">
                </td>
            </tr>
        <?php endforeach;?>
	</tbody>
</table>
<?php if ($this->showForm) echo CHtml::endForm();?>
