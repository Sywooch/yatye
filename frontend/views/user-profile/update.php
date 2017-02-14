<?php

use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\UserProfile */

$this->title = 'Edit Profile: ' . $model->first_name . ' ' . $model->last_name;
$this->params['breadcrumbs'][] = ['label' => 'User Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="container">
    <div class="row">
        <ol class="breadcrumb bread-primary" style="background: none;">
            <li><a href="<?php echo Yii::$app->request->baseUrl ?>"><?php echo Yii::$app->name; ?></a></li>
            <li class="active"><a href="<?php echo Url::to(['update-user']) ?>">Edit Profiles</a></li>
        </ol>
    </div>
    <div class="row">
        <?php $data = $this->context->accessData(); echo $this->render('@app/views/layouts/_side_bar', ['data' => $data]); ?>

        <div class="col-sm-8 col-lg-9">
            <div class="page-title">
                <h1><?= Html::encode($this->title) ?></h1>
            </div>

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>


