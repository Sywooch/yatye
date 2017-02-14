<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 23/07/2016
 * Time: 22:36
 */
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\widgets\Pjax;
$this->title = Yii::$app->name . ' - ' . $model->name;
$dataProvider->pagination = [
    'pageSize' => 6,
];
?>
<div class="container">
    <div class="row">
        <ol class="breadcrumb bread-primary" style="background: none;">
            <li><a href="<?php echo Url::to(['/category/' . $model->getCategorySlug()]) ?>"><?php echo $model->getCategoryName() ?></a></li>
            <li class="active"><a href="<?php echo Url::to(['/service/' . $model->slug]) ?>"><?php echo $model->name ?></a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-sm-8 col-lg-9">
            <div class="content">

                <div class="cards-row">
                    <?php Pjax::begin([
                        'enablePushState' => false,
                        'enableReplaceState' => false
                    ]); ?>
                    <?= ListView::widget([
                        'options' => [
                            'tag' => 'div',
                        ],
                        'dataProvider' => $dataProvider,
                        'itemView' => function ($model, $key, $index, $widget) {
                            return $this->render('_list_item', ['model' => $model]);

                        },
                        'itemOptions' => [
                            'tag' => false,
                            'class' => 'item'
                        ],

                        /* do not display {summary} */
                        'layout' => '{items}{pager}',

                        'pager' => [
                            'prevPageLabel' => 'Prev',
                            'nextPageLabel' => 'Next',
                            'maxButtonCount' => 12,
                            'options' => [
                                'class' => 'pager col-xs-12'
                            ]
                        ],

                    ]); ?>
                    <?php Pjax::end(); ?>
                </div>

                <!--                --><?php
                //                if (!empty($model->type === Yii::$app->params['A_TYPE'])) :
                //                    echo $this->render('/list/_a_list', [
                //                        'model' => $model,
                //                        'services' => $services,
                //                        'pagination' => $pagination,
                //                    ]);
                //                elseif (!empty($model->type === Yii::$app->params['B_TYPE'])) :
                //                    echo $this->render('/list/_b_list', [
                //                        'model' => $model,
                //                        'services' => $services,
                //                        'pagination' => $pagination,
                //                    ]);
                //                elseif (!empty($model->type === Yii::$app->params['C_TYPE'])) :
                //                    echo $this->render('/list/_free_list', [
                //                        'model' => $model,
                //                        'services' => $services,
                //                        'pagination' => $pagination,
                //                    ]);
                //                endif;
                //                ?>
            </div>
        </div>
        <?php echo $this->render('@app/views/layouts/_right_side') ?>
    </div>
</div>