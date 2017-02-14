<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;
use yii\bootstrap\Modal;
use kartik\form\ActiveForm;
use kartik\widgets\Typeahead;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="page-title">
            <h1><?= Html::encode($this->title) ?></h1>
        </div><!-- /.page-title -->

        <div class="background-white p20 mb50">
            <div class="row">
                <div class="col-sm-3">
                    <div class="hero-widget well well-sm">
                        <div class="icon">
                            <i class="glyphicon glyphicon-list"></i>
                        </div>
                        <div class="text">
                            <var></var>
                            <label class="text-muted">Post Categories</label>
                        </div>
                        <div class="options">
                            <?= Html::a(Html::tag('i', ' Add New Category', ['class' => 'fa fa-plus']), ['/post-category/create'], ['class' => 'btn btn-primary btn-xs']) ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="hero-widget well well-sm">
                        <div class="icon">
                            <i class="glyphicon glyphicon-list"></i>
                        </div>
                        <div class="text">
                            <var></var>
                            <label class="text-muted">Post</label>
                        </div>
                        <div class="options">
                            <?= Html::a(Html::tag('i', ' Add New Post', ['class' => 'fa fa-plus']), ['create'], ['class' => 'btn btn-sm btn-primary']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if (!empty($posts)): ?>
            <div class="background-white p20 mb50">
                <div class="row">

                    <div class="table-responsive">

                        <table id="mytable" class="table table-bordred table-striped">
                            <thead>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Category</th>
                            <th>Created By</th>
                            <th>Created At</th>
                            </thead>
                            <tbody>
                            <?php foreach ($posts as $post): ?>
                                <?php if ($post->status == Yii::$app->params['pending']): ?>
                                    <?php $status = 'fa fa-spinner'; ?>
                                <?php elseif ($post->status == Yii::$app->params['rejected']): ?>
                                    <?php $status = 'fa fa-fa-trash-o'; ?>

                                <?php elseif ($post->status == Yii::$app->params['active']): ?>
                                    <?php $status = 'fa fa-times'; ?>
                                <?php else : ?>
                                    <?php $status = 'fa fa-check'; ?>
                                <?php endif; ?>
                                <tr>
                                    <td><?= $post->title ?></td>
                                    <td><?= $post->post_type_id ?></td>
                                    <td><?= $post->post_category_id ?></td>
                                    <td><?= $post->created_by ?></td>
                                    <td><?= $post->created_at ?></td>
                                    <td>
                                        <table>
                                            <tr>
                                                <td>
                                                    <?= Html::a(Html::tag('span', '', ['class' => 'fa fa-eye']), Yii::$app->request->baseUrl . '/post/view?id=' . $post->id, ['class' => 'btn btn-primary btn-circle']) ?>
                                                </td>
                                                <td>
                                                    <?= Html::a(Html::tag('span', '', ['class' => 'fa fa-edit']), Yii::$app->request->baseUrl . '/post/update?id=' . $post->id, ['class' => 'btn btn-primary btn-circle']) ?>
                                                </td>
                                                <td>
                                                    <?= Html::a(Html::tag('span', '', ['class' => $status]), Yii::$app->request->baseUrl . '/post/status/?id=' . $post->id, ['class' => 'btn btn-primary btn-circle']) ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            </tbody>

                        </table>

                        <div class="clearfix"></div>
                        <ul class="pagination pull-right">
                            <?= LinkPager::widget(['pagination' => $pagination]) ?>
                        </ul>

                    </div>

                </div>
            </div>
        <?php endif; ?>
    </div>
</div>


