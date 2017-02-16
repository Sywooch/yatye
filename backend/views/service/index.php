<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\assets\RwandaguideAsset;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Services';
$this->params['breadcrumbs'][] = $this->title;

RwandaguideAsset::register($this);
?>
<div class="row">
    <div class="col-sm-12">
        <div class="page-title">
            <h1><?= Html::encode($this->title) ?></h1>
        </div><!-- /.page-title -->

        <div class="background-white p20 mb50">
            <h4 class="page-title">
                <?= Html::a(Html::tag('span', ' New Service', ['class' => 'fa fa-plus']), ['create'], ['class' => 'btn btn-primary', 'title' => 'Add New Service']) ?>
                <?= Html::a(Html::tag('span', ' Service Category', ['class' => 'fa fa-list']), ['/category'], ['class' => 'btn btn-primary', 'title' => 'Category']) ?>
            </h4>

            <div class="container bootstrap snippet">
                <div class="div">
                    <div class="col-sm-7">
                        <div class="panel-group drop-accordion" id="accordion" role="tablist" aria-multiselectable="true">
                            <?php if(!empty($categories)): ?>
                                <?php foreach($categories as $category): ?>
                                    <div class="panel panel-default">
                                        <div class="panel-heading collapsed" role="tab" id="heading-<?php echo $category->id; ?>">
                                            <h4 class="panel-title">
                                                <a class="collapse-controle" data-toggle="collapse" data-parent="#accordion" href="#collapse-<?php echo $category->id; ?>" aria-expanded="true" aria-controls="collapse-<?php echo $category->id; ?>">
                                                    <?php echo $category->name; ?>
                                                    <span class="expand-icon-wrap"><i class="fa expand-icon"></i></span>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse-<?php echo $category->id; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-<?php echo $category->id; ?>" aria-expanded="true">
                                            <div class="panel-body">
                                                <?php $services = $model->getServicesByCategoryId($category->id);
                                                if(!empty($services)):?>

                                                    <table class="table mb0">
                                                        <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Status</th>
                                                            <th></th>
                                                        </tr>
                                                        </thead>

                                                        <tbody>
                                                        <?php foreach ($services as $service): ?>

                                                            <?php if ($service->status == Yii::$app->params['inactive']): ?>
                                                                <?php $status = 'fa fa-check'; ?>
                                                            <?php else: ?>
                                                                <?php $status = 'fa fa-times'; ?>
                                                            <?php endif; ?>
                                                            <tr>
                                                                <td><?= $service->name ?></td>
                                                                <td>
                                                                    <?= Html::a(Html::tag('span', '', ['class' => $status]), Yii::$app->request->baseUrl . '/service/status/?id=' . $service->id, ['class' => 'btn btn-primary btn-circle', 'title' => 'Activate/Deactivate ' . $service->name]) ?>
                                                                </td>
                                                                <td>
                                                                    <table>
                                                                        <tr>
                                                                            <td>
                                                                                <?= Html::a(Html::tag('span', '', ['class' => 'fa fa-eye']), Yii::$app->request->baseUrl . '/service/view?id=' . $service->id, ['class' => 'btn btn-primary btn-xs', 'title' => 'View ' . $service->name]) ?>
                                                                            </td>
                                                                            <td>
                                                                                <?= Html::a(Html::tag('span', '', ['class' => 'fa fa-edit']), Yii::$app->request->baseUrl . '/service/update?id=' . $service->id, ['class' => 'btn btn-primary btn-xs', 'title' => 'Update ' . $service->name]) ?>
                                                                            </td>
                                                                            <td>
                                                                                <?= Html::a(Html::tag('span', '', ['class' => 'fa fa-plus']), Yii::$app->request->baseUrl . '/service/add-places?service_id=' . $service->id, ['class' => 'btn btn-primary btn-xs', 'title' => 'Add places ' . $service->name]) ?>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <!-- /#accordion -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

