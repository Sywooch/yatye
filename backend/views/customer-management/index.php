<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\bootstrap\Modal;
use kartik\form\ActiveForm;
use kartik\widgets\Typeahead;
use yii\helpers\Url;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title = 'Customer Management';
?>
<div class="background-white p20 mb50">
<!--    <h3>Export List of clients</h3>-->
<!--    --><?php //$gridColumns = [
//        ['class' => 'kartik\grid\SerialColumn'],
//        'name',
//        'emails',
//        'mobile_phones',
//        'land_line',
//        ['class' => 'kartik\grid\ActionColumn', 'urlCreator'=>function(){return '#';}]
//    ];
//
//    echo ExportMenu::widget([
//        'dataProvider' => $dataProvider,
//        'columns' => $gridColumns,
//        'fontAwesome' => true,
//        'target' => '_blank',
//    ]) . "<hr>\n".
//
//    GridView::widget([
//        'dataProvider' => $dataProvider,
//        'columns' => $gridColumns,
//    ]); ?>

    <div class="row">
        <div class="col-sm-12 col-lg-4">
            <div class="row">
                <div class="col-sm-6">
                    <div class="statusbox">
                        <h2>Contracts</h2>
                        <div class="statusbox-content">
                            <strong>0</strong>
                            <span></span>
                        </div>

                        <div class="statusbox-actions">
                            <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-eye']), Yii::$app->request->baseUrl . '/contract', ['class' => '']) ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="statusbox">
                        <h2>Clients</h2>
                        <div class="statusbox-content">
                            <strong>0</strong>
                            <span></span>
                        </div>

                        <div class="statusbox-actions">
                            <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-eye']), Yii::$app->request->baseUrl . '/client', ['class' => '']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-4">
            <div class="row">
                <div class="col-sm-6">
                    <div class="statusbox">
                        <h2>Invoices</h2>
                        <div class="statusbox-content">
                            <strong>0</strong>
                            <span></span>
                        </div>

                        <div class="statusbox-actions">
                            <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-eye']), Yii::$app->request->baseUrl . '/invoice', ['class' => '']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
