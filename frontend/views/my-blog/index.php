<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'My Blogs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row">
        <ol class="breadcrumb bread-primary" style="background: none;">
            <li><a href="<?php echo Yii::$app->request->baseUrl ?>"><?php echo Yii::$app->name; ?></a></li>
            <li class="active"><a href="<?php echo Url::to(['/my-blog']) ?>">My Blog</a></li>
        </ol>
    </div>
    <div class="row">
        <?php $data = $this->context->accessData(); echo $this->render('@app/views/layouts/_side_bar', ['data' => $data]); ?>
        <div class="col-sm-8 col-lg-9">
            <div class="background-white p20 mb30">
                <h3 class="page-title">
                    List of my blogs
                    <?= Html::a('New Blog', ['create'], ['class' => 'btn btn-primary btn-xs pull-right']) ?>
                </h3>
                <div class="row">
                    <div class="posts p30">
                        <?= ListView::widget([
                            'options' => [
                                'tag' => 'div',
                            ],
                            'dataProvider' => $dataProvider,
                            'itemView' => function ($model, $key, $index, $widget) {
                                return $this->render('_list_item',['model' => $model]);
                            },
                            'itemOptions' => [
                                'tag' => false,
                            ],
                            'summary' => '',

                            /* do not display {summary} */
                            'layout' => '{items}{pager}',

                            'pager' => [
                                'firstPageLabel' => 'First',
                                'lastPageLabel' => 'Last',
                                'maxButtonCount' => 4,
                                'options' => [
                                    'class' => 'pagination col-xs-12'
                                ]
                            ],

                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
