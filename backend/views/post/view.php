<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model backend\models\Post */

$this->title = $model->title;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Posts'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-sm-12">
        <div class="page-title">
            <h1><?= Html::encode($this->title) ?></h1><small><a href="<?php echo 'http://rwandaguide.info/post-details/' . $model->slug ?>" target="_blank"><i class="fa fa-eye"></i></a></small>
        </div><!-- /.page-title -->

        <div class="background-white p20 mb50">
            <div class="panel-body">
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">

                    <?php if($model->image != ''): ?>
                        <img class="img-responsive thumbnail" alt=""
                             src="<?php echo Yii::$app->params['post_images'] . $model->image ?>"/>
                        <a class="btn btn-xs btn-danger" href="<?php echo Yii::$app->request->baseUrl . '/post/delete-post-picture/?id=' . $model->id; ?>">Delete</a>
                    <?php endif; ?>

                    <?php $form = ActiveForm::begin([
                        'options' => ['enctype' => 'multipart/form-data'],
                        'action' => Yii::$app->request->baseUrl . '/post/post-picture/?id=' . $model->id,
                        'id' => 'upload-post-picture-form',
                    ]); ?>
                    <span class="btn btn-default btn-xs btn-file">
                        <?php echo $form->field($model, 'image_file')->fileInput([
                            'multiple' => false,
                            'onchange' => 'this.form.submit()',
                            'id' => 'postPictureUpload',
                            'class' => 'btn btn-primary btn-xs',
                            'accept' => 'image/*',
                        ])->label('Upload Post Picture'); ?>
                    </span>
                    <?php ActiveForm::end(); ?>
                    <br><small>Min Width: 512 <br> Min Heigth: 384 <br> Max Width: 768</small>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <div class="row">
                        <table class="table table-user-information">
                            <tbody>
                            <tr>
                                <td>Title:</td>
                                <td><?= $model->title ?></td>
                            </tr>
                            <tr>
                                <td>Introduction:</td>
                                <td><?= nl2br($model->introduction) ?></td>
                            </tr>
                            <tr>
                                <td>Slug:</td>
                                <td><?= $model->slug ?></td>
                            </tr>
                            <tr>
                                <td>Image:</td>
                                <td><?= $model->image ?></td>
                            </tr>
                            <tr>
                                <td>Caption:</td>
                                <td><?= $model->caption ?></td>
                            </tr>
                            <tr>
                                <td>Content:</td>
                                <td><?= nl2br($model->content) ?></td>
                            </tr>
                            <tr>
                                <td>Created At:</td>
                                <td><?= $model->created_at ?></td>
                            </tr>

                            <tr>
                                <td>Updated At:</td>
                                <td><?= $model->updated_at ?></td>
                            </tr>
                            <tr>
                                <td>Created By:</td>
                                <td><?= $model->created_by ?></td>
                            </tr>
                            <tr>
                                <td>Updated By:</td>
                                <td><?= $model->updated_by ?></td>
                            </tr>
                            <tr>
                                <td>Status:</td>
                                <td><?= $model->status ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="panel-footer">
                <?php echo Html::a(Html::tag('span', '', ['class' => 'fa fa-arrow-left']), ['index'], ['class' => 'btn btn-sm btn-primary']) ?>
                <span class="pull-right">
                    <?php if ($model->status != Yii::$app->params['active']) : ?>
                    <?= Html::a(Html::tag('span', '', ['class' => 'fa fa-upload']), ['publish', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?>
                    <?php endif; ?>
                    <?= Html::a(Html::tag('span', '', ['class' => 'fa fa-edit']), ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?>
                    <?php echo Html::a(Html::tag('span', '', ['class' => 'fa fa-remove']), ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ])
                    ?>
                </span>
            </div>
        </div>
    </div>
</div>
