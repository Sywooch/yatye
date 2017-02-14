<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 14/02/2016
 * Time: 20:04
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
$this->title = 'List of Places';
?>
<div class="row">
    <div class="col-sm-12">
        <div class="page-title">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="background-white p20 mb50">
            <div class="row">
                <?php echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    'showFooter' => true,
                    'showHeader' => true,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'label' => 'Name',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return Html::a($model->name, ['/settings', 'id' => $model->id], ['target' => '_blank']);
                            },
                        ],
                        [
                            'attribute' => 'profile_type',
                            'label' => Yii::t('app', 'Profile Type'),
                            'value' => function ($model) {
                                return $model->getProfileTypeName();
                            },
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{status} {settings} {reject}',
                            'buttons' => [
                                'status' => function ($url, $model) {
                                    return Html::a(Html::tag('i', '', ['class' => ($model['status'] == Yii::$app->params['inactive']) ? 'fa fa-check' : 'fa fa-times']), Yii::$app->request->baseUrl . '/place/status/?id=' . $model['id'], [
                                        'class' => 'btn btn-primary btn-xs',
                                    ]);
                                },
                                'settings' => function ($url, $model) {
                                    return Html::a(Html::tag('i', '', ['class' => 'fa fa-cog']), Yii::$app->request->baseUrl . '/settings/?id=' . $model['id'], [
                                        'class' => 'btn btn-primary btn-xs',
                                    ]);
                                },
                                'reject' => function ($url, $model) {
                                    return Html::a(Html::tag('i', '', ['class' => 'fa fa-trash']), Yii::$app->request->baseUrl . '/place/reject/?id=' . $model['id'], [
                                        'class' => 'btn btn-danger btn-xs',
                                    ]);
                                },
                            ],
                        ],
                    ],

                    'tableOptions' => ['class' => 'table mb0'],
                ]); ?>
            </div>
        </div>
    </div>
</div>