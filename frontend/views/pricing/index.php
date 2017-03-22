<?php
/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Pricing');

use yii\helpers\Url;
use yii\widgets\ListView;

$dataProvider->pagination = [
    'pageSize' => 3,
];
?>

<div class="container">
    <div class="mt-80">
        <div class="page-header">
            <h1><?php echo Yii::t('app', 'Fair Pricing') ?></h1>
            <p><?php echo Yii::t('app', 'Rwanda Guide offers the best pricing options for your business to get discovered and enable it to reach out to new customers.') ?> <?php echo Yii::t('app', 'If you are interested <br>in special plan don\'t hesitate and ') ?><a href="http://rwandaguide.info/contact-us">contact us</a>.</p>
        </div>

        <div class="pricings">
            <div class="row">
                <?= ListView::widget([
                    'options' => [
                        'tag' => 'div',
                    ],
                    'dataProvider' => $dataProvider,
                    'itemView' => function ($model, $key, $index, $widget) {

                        $itemContent = $this->render('_item', ['model' => $model]);
                        return $itemContent;

                    },
                    'itemOptions' => [
                        'tag' => false,
                        'class' => 'item'
                    ],
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
            </div>
        </div>
    </div>
</div>
