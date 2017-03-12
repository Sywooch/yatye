<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Blog */

$this->title = $model->title;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Blogs'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-sm-12">
        <div class="page-title">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>

        <div class="background-white p20 mb50">
            <div class="panel-body">
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
                            <td><?= $model->getUser() ?></td>
                        </tr>
                        <tr>
                            <td>Updated By:</td>
                            <td><?= $model->getUser() ?></td>
                        </tr>
                        <tr>
                            <td>Status:</td>
                            <td><?= $model->getStatus() ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                <?php echo Html::a(Html::tag('span', '', ['class' => 'fa fa-arrow-left']), ['index'], ['class' => 'btn btn-sm btn-primary']) ?>
                <span class="pull-right">
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