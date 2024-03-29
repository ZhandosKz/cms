<?php
/**
 * TbImageGallery class file.
 *
 * Implementation of Bootstrap Image Gallery
 * @author Ruslan Fadeev <fadeevr@gmail.com>
 * @link https://github.com/blueimp/Bootstrap-Image-Gallery/
 */

class TbImageGallery extends CWidget
{
    /**
     * @var string name of the view to display images (modal dialog used for the image gallery)
     */
    public $previewImagesView = 'bootstrap.views.gallery.preview';

    /**
     * @var bool enable full screen
     */
    public $fullScreen = true;

    /**
     * @var bool enable/disable Modal Gallery event listener
     * @see https://github.com/blueimp/Bootstrap-Image-Gallery/blob/master/README.md#deinitialize-the-click-event-listener
     */
    public $eventListener = true;

    /**
     * @var array htmlOptions for gallery div
     * @see https://github.com/blueimp/Bootstrap-Image-Gallery/blob/master/README.md#api
     */
    public $htmlOptions = array();

    public static $defaultHtmlOptions = array(
        'data-toggle' => 'modal-gallery',
        'data-target' => '#modal-gallery',
        'data-filter' => '*',
    );

    public function init()
    {
        $this->getController()->module->bootstrap->registerAssetCss('bootstrap-image-gallery' . (!YII_DEBUG ? '.min' : '') . '.css');
        $this->getController()->module->bootstrap->registerAssetJs('fileupload/load-image.min.js');
        $this->getController()->module->bootstrap->registerAssetJs('bootstrap-image-gallery' . (!YII_DEBUG ? '.min' : '') . '.js');
        if ($this->fullScreen) {
            Yii::app()->clientScript->registerScript($this->id, 'jQuery("#' . $this->id . '").addClass("modal-fullscreen");', CClientScript::POS_READY);
        }
        if (!$this->eventListener) {
            Yii::app()->clientScript->registerScript($this->id, '$(document.body).off(".modal-gallery.data-api");');
        }
        if (!isset($this->htmlOptions['id'])) {
            $this->htmlOptions['id'] = $this->id;
        }
        echo CHtml::openTag('div', CMap::mergeArray(self::$defaultHtmlOptions, $this->htmlOptions));
    }

    public function run()
    {
        $this->render($this->previewImagesView);
        echo CHtml::closeTag('div');
    }
}
