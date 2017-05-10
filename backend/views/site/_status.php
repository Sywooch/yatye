<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 5/9/17
 * Time: 10:10 AM
 */
use yii\helpers\Html;
?>

<div class="panel">
    <div class="panel-heading">
        <?= Html::a(Yii::t('app', 'More Reports'), ['report'], ['class' => 'btn btn-primary btn-xs pull-right', 'style'=>'']) ?>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12 col-lg-4">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="statusbox">
                            <h2>Pending</h2>
                            <div class="statusbox-content">
                                <strong>
                                    <?php $data = $this->context->accessDataByIds(Yii::$app->params['pending']);
                                    echo $data['get_places_with_status']; ?>
                                </strong>
                                <span></span>
                            </div>

                            <div class="statusbox-actions">
                                <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-eye']), Yii::$app->request->baseUrl . '/place/list?status=pending', ['class' => '']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="statusbox">
                            <h2>Active</h2>
                            <div class="statusbox-content">
                                <strong>
                                    <?php $data = $this->context->accessDataByIds(Yii::$app->params['active']);
                                    echo $data['get_places_with_status']; ?>
                                </strong>
                                <span></span>
                            </div>

                            <div class="statusbox-actions">
                                <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-eye']), Yii::$app->request->baseUrl . '/place/list?status=active', ['class' => '']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-4">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="statusbox">
                            <h2>Inactive</h2>
                            <div class="statusbox-content">
                                <strong>
                                    <?php $data = $this->context->accessDataByIds(Yii::$app->params['inactive']);
                                    echo $data['get_places_with_status']; ?>
                                </strong>
                                <span></span>
                            </div>

                            <div class="statusbox-actions">
                                <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-eye']), Yii::$app->request->baseUrl . '/place/list?status=inactive', ['class' => '']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="statusbox">
                            <h2>Rejected</h2>
                            <div class="statusbox-content">
                                <strong>
                                    <?php $data = $this->context->accessDataByIds(Yii::$app->params['rejected']);
                                    echo $data['get_places_with_status']; ?>
                                </strong>
                                <span></span>
                            </div>

                            <div class="statusbox-actions">
                                <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-eye']), Yii::$app->request->baseUrl . '/place/list?status=rejected', ['class' => '']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-4">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="statusbox">
                            <h2>Imported</h2>
                            <div class="statusbox-content">
                                <strong>
                                    <?php $data = $this->context->accessDataByIds(Yii::$app->params['imported']);
                                    echo $data['get_places_with_status']; ?>
                                </strong>
                                <span></span>
                            </div>

                            <div class="statusbox-actions">
                                <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-eye']), Yii::$app->request->baseUrl . '/place/list?status=imported', ['class' => '']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
