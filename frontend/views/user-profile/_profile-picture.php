<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 16/04/2016
 * Time: 17:59
 */
use yii\widgets\ActiveForm;
$this->registerCss('
.btn-file {
    position: absolute;
    overflow: hidden;
}
');

?>
<div class="widget">
    <div class="user-photo">
        <a href="#">
            <img src="<?php echo $data['get_profile_picture']; ?>" alt="User Photo">
            <?php $form = ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data'],
                'action' => Yii::$app->request->baseUrl . '/user-profile/profile-picture',
                'id'=>'upload-gallery-form',
            ]); ?>
            <span class="user-photo-action btn-file">
                <?php echo $form->field($model, 'image')->fileInput([
                    'multiple' => false,
                    'onchange' => 'this.form.submit()',
                    'id' => 'galleryUpload',
                    'class' => '',
                    'accept' => 'image/*',
                ])->label(false); ?>
                Click here to reupload</span>

            <?php ActiveForm::end(); ?>
        </a>

    </div>
</div>
