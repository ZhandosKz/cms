<div class="topbar" style="display: none">
    <h2 id="name"></h2>
    <span id="close" class="back">К списку альбомов</span>
</div>
<ul id="tp-grid" class="tp-grid">
    <?php foreach ($galleries as $gallery):?>
        <?php foreach ($gallery->images as $image): ?>
            <li data-pile="<?=$gallery->title?>">
                <a href="/images/uploads/<?=$gallery->id?>/<?=$image->filename?>">
                    <span class="tp-info"><span><?=(!empty($image->description)) ? $image->description : 'нет описания'?></span></span>
                    <img style="width: 200px; " src="/images/uploads/<?=$gallery->id?>/<?=$image->filename?>" />
                </a>
            </li>
        <?php endforeach; ?>
    <?php endforeach;?>
</ul>