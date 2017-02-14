<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\UserProfile */

$this->title = $model->first_name . ' ' . $model->last_name;
?>

<div class="container">
    <div class="row">
        <ol class="breadcrumb bread-primary" style="background: none;">
            <li><a href="<?php echo Yii::$app->request->baseUrl ?>"><?php echo Yii::$app->name; ?></a></li>
            <li><a href="<?php echo Url::to(['update-user']) ?>">Edit Profile</a></li>
            <li class="active"><a href="<?php echo Url::to(['view', 'id' => $model->id]) ?>"><?= $model->first_name . ' ' . $model->last_name ?></a></li>
        </ol>
    </div>
    <div class="row">
        <?php $data = $this->context->accessData(); echo $this->render('@app/views/layouts/_side_bar', ['data' => $data]); ?>

        <div class="col-sm-8 col-lg-9">
            <div class="page-title">
                <h1><?= Html::encode($this->title) ?></h1>
            </div>
            <p>

                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger btn-xs pull-right',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
                <?= Html::a('Edit Profile', ['update-user'], ['class' => 'btn btn-primary btn-xs pull-right']) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
//                    'id',
//                    'user_id',
//                    'place_id',
                    'first_name',
                    'last_name',
                    'middle_name',
                    'birthdate',
                    'gender',
//                    'avatar',
                    'bio:ntext',
                    'email:email',
                    'phone',
                    'facebook',
                    'twitter',
                    'google_plus',
                    'linkedin',
                    'instagram',
//                    'created_at',
//                    'expire_at',
//                    'updated_at',
//                    'status',
                ],
            ]) ?>
        </div>
    </div>
</div>
