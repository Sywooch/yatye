<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 21/02/2016
 * Time: 01:15
 */
/* @var $this yii\web\View */
/* @var $model common\models\Address */
/* @var $form yii\widgets\ActiveForm */

use toriphes\lazyload\LazyLoad;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\widgets\DepDrop;
use yii\widgets\Pjax;
use backend\assets\RwandaguideAsset;

RwandaguideAsset::register($this);
$this->registerCss("

")
?>
<div class="row">
    <p>
        <code>Min Width: 512 | Min Heigth: 384 | Max Width: 768
            <br>You can upload more than one pictures. Max: 15 pictures</code>
    </p>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="row">
            <?php $form = ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data'],
                'action' => Url::to([(Yii::$app->controller->id == 'settings') ? 'settings/set-gallery' : 'place/set-gallery', 'place_id' => $place_id]),
                'id' => 'upload-gallery-form',
            ]); ?>

            <div class="form-group">
                <span class="btn btn-default btn-xs btn-file">
                <?php echo $form->field($gallery_modal, 'image[]')->fileInput([
                    'multiple' => true,
                    'onchange' => 'this.form.submit()',
                    'id' => 'galleryUpload',
                    'class' => 'btn btn-primary btn-xs form-control',
                    'accept' => 'image/*',
                ])->label('Upload New Image'); ?>
            </span>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<br>
<br>

<div class="row">
    <?php if (!empty($gallery)): ?>
        <div class='list-group gallery'>
            <?php foreach ($gallery as $photo): ?>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <img class="img-responsive thumbnail" alt="<?php echo $photo->name ?>"
                         src="<?php echo Yii::$app->params['galleries'] . $photo->name ?>" style="width: 240px; height: 140px;"/>
                    <div style="margin-top: -20px; margin-bottom: 20px;">
                        <?php if ($photo->logo == 'no'): ?>
                            <a class="btn btn-xs btn-secondary"
                               href="<?php echo Url::to([(Yii::$app->controller->id == 'settings') ? 'settings/activate-logo' : 'place/activate-logo', 'id' => $photo->id, 'place_id' => $photo->place_id]); ?>">
                                <i class="fa fa-photo"></i></a>
                        <?php endif; ?>
                        <a class="btn btn-xs btn-danger" data-confirm="Are you sure you want to delete this item?" data-method="post"
                           href="<?php echo Url::to([(Yii::$app->controller->id == 'settings') ? 'settings/delete-gallery' : 'place/delete-gallery', 'gallery_id' => $photo->id, 'place_id' => $photo->place_id]); ?>">
                            <i class="fa fa-trash"></i></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>