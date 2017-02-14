<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Working Hours';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-sm-8 col-sm-offset-2">
        <div class="page-title">
            <h1><?= Html::encode($this->title) ?></h1>
        </div><!-- /.page-title -->

        <div class="background-white p20 mb50">
            <table class="table mb0">
                <thead>
                <tr>
                    <th>Days</th>
                    <th>Opening Time</th>
                    <th>Closing Time</th>
                    <th>Closing Day</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                <?php if (!empty($working_hours)): ?>
                    <?php foreach ($working_hours as $working_hour):; ?>
                        <tr>
                            <td><?= $working_hour->day ?></td>
                            <td><?= $working_hour->opening_time ?></td>
                            <td><?= $working_hour->closing_time ?></td>
                            <td><?= $working_hour->closed ?></td>
                            <td>
                                <?php
                                echo Html::a(Html::tag('span', '', ['class' => 'fa fa-edit']), Yii::$app->request->baseUrl . '/working-hours/update?id=' . $working_hour->id . '&place_id=' . $working_hour->place_id, ['class' => 'btn btn-primary btn-circle', 'title' => 'Update ' . $working_hour->day]);
                                //                                    echo Html::button(Html::tag('span', '', ['class' => 'fa fa-edit']), ['value' => Url::to(Yii::$app->request->baseUrl . '/working-hours/update?id=' . $working_hour->id . '&place_id=' . $working_hour->place_id), 'class' => 'btn btn-primary', 'id' => 'modal-working_hours-button' . $working_hour->place_id]);

                                Modal::begin([
                                    'id' => 'modal-working_hours' . $working_hour->place_id,
                                    'size' => 'modal-lg',
                                ]);

                                echo "<div id='modal-working_hours_content' style='padding-left: 50px'></div>";

                                Modal::end();
                                $this->registerJs("$('#modal-working_hours-button" . $working_hour->place_id . "').click(function (){
                                        $('#modal-working_hours" . $working_hour->place_id . "').modal('show')
                                            .find('#modal-working_hours_content')
                                            .load($(this).attr('value'));
                                    });")
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
