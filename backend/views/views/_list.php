<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 29/05/2016
 * Time: 02:34
 */

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\bootstrap\Modal;
use kartik\form\ActiveForm;
use kartik\widgets\Typeahead;
use yii\helpers\Url;

$this->title = 'Views';
?>
<div class="background-white p20 mb50">
    <div class="col-sm-12">
        <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-arrow-left']), Yii::$app->request->baseUrl . '/views', ['class' => 'btn btn-primary']) ?>
    </div>
    <table class="table mb0">
        <thead>
        <tr>
            <th>Name</th>
            <th>Views</th>
            <th>Last viewed</th>
            <th>Status</th>
        </tr>
        </thead>

        <tbody>
        <?php if (!empty($views)): ?>
            <?php foreach ($views as $view): $id = $view['id']; ?>

                <?php if ($view['status'] == Yii::$app->params['inactive']): ?>
                    <?php $status = 'fa fa-check'; ?>
                <?php else: ?>
                    <?php $status = 'fa fa-times'; ?>
                <?php endif; ?>
                <tr>
                    <td>
                        <?= Html::a($view['name'], Url::to(['views-list/', 'views_id' => $id]), ['class' => '', 'title' => '']) ?>
                    </td>
                    <td><?= $view['views'] ?></td>
                    <td><?= date('D j M  G:i T Y', strtotime($view['updated_at'])) ?></td>
                    <td>
                        <?= Html::a(Html::tag('span', '', ['class' => $status]), Yii::$app->request->baseUrl . '/views/activate-view?id=' . $id, ['class' => 'btn btn-primary btn-circle', 'title' => 'Activate/Deactivate ']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
    <?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>

