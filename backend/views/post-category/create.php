<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PostCategory */

$this->title = Yii::t('app', 'New Post Category');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Post Categories'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-sm-12">
        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_form', [
            'model' => $model,
            'post_types' => $post_types,
        ]) ?>
    </div>
</div>
