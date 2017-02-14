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
    <h3>Export List of clients</h3>
    <?php

    $gridColumns = [
        ['class' => 'kartik\grid\SerialColumn'],
        'name',
        'emails',
        'mobile_phones',
        'land_line',
//        'webstes',
        ['class' => 'kartik\grid\ActionColumn', 'urlCreator'=>function(){return '#';}]
    ];

    echo ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'fontAwesome' => true,
//        'batchSize' => 0,
        'target' => '_blank',
    ]) . "<hr>\n".

    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
    ]);

    ?>
</div>
