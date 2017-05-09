<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 5/9/17
 * Time: 10:13 AM
 */
use yii\helpers\Html;

?>

<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12 col-lg-4">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="statusbox">
                            <h2>Desc.</h2>
                            <div class="statusbox-content">
                                <strong>
                                    <?php $data = $this->context->accessData();
                                    echo $data['get_places_with_empty_fields']['descriptions']; ?>
                                </strong>
                                <span></span>
                            </div>

                            <div class="statusbox-actions">
                                <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-eye']), Yii::$app->request->baseUrl . '/place/list?attribute=description', ['class' => '']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="statusbox">
                            <h2>Slug</h2>
                            <div class="statusbox-content">
                                <strong>
                                    <?php $data = $this->context->accessData();
                                    echo $data['get_places_with_empty_fields']['slugs']; ?>
                                </strong>
                                <span></span>
                            </div>

                            <div class="statusbox-actions">
                                <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-eye']), Yii::$app->request->baseUrl . '/place/list?attribute=slug', ['class' => '']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-4">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="statusbox">
                            <h2>Logo</h2>
                            <div class="statusbox-content">
                                <strong>
                                    <?php $data = $this->context->accessData();
                                    echo $data['get_places_with_empty_fields']['logos']; ?>
                                </strong>
                                <span></span>
                            </div>

                            <div class="statusbox-actions">
                                <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-eye']), Yii::$app->request->baseUrl . '/place/list?attribute=logo', ['class' => '']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="statusbox">
                            <h2>Profile</h2>
                            <div class="statusbox-content">
                                <strong>
                                    <?php $data = $this->context->accessData();
                                    echo $data['get_places_with_empty_fields']['profile_types']; ?>
                                </strong>
                                <span></span>
                            </div>

                            <div class="statusbox-actions">
                                <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-eye']), Yii::$app->request->baseUrl . '/place/list?attribute=imported', ['class' => '']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-4">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="statusbox">
                            <h2>Longitude</h2>
                            <div class="statusbox-content">
                                <strong>
                                    <?php $data = $this->context->accessData();
                                    echo $data['get_places_with_empty_fields']['longitudes']; ?>
                                </strong>
                                <span></span>
                            </div>

                            <div class="statusbox-actions">
                                <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-eye']), Yii::$app->request->baseUrl . '/place/list?attribute=longitude', ['class' => '']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="statusbox">
                            <h2>Latitude</h2>
                            <div class="statusbox-content">
                                <strong>
                                    <?php $data = $this->context->accessData();
                                    echo $data['get_places_with_empty_fields']['latitudes']; ?>
                                </strong>
                                <span></span>
                            </div>

                            <div class="statusbox-actions">
                                <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-eye']), Yii::$app->request->baseUrl . '/place/list?attribute=latitude', ['class' => '']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-lg-4">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="statusbox">
                            <h2>Province</h2>
                            <div class="statusbox-content">
                                <strong>
                                    <?php $data = $this->context->accessData();
                                    echo $data['get_places_with_empty_fields']['provinces']; ?>
                                </strong>
                                <span></span>
                            </div>

                            <div class="statusbox-actions">
                                <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-eye']), Yii::$app->request->baseUrl . '/place/list?attribute=province', ['class' => '']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="statusbox">
                            <h2>District</h2>
                            <div class="statusbox-content">
                                <strong>
                                    <?php $data = $this->context->accessData();
                                    echo $data['get_places_with_empty_fields']['districts']; ?>
                                </strong>
                                <span></span>
                            </div>

                            <div class="statusbox-actions">
                                <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-eye']), Yii::$app->request->baseUrl . '/place/list?attribute=district', ['class' => '']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-4">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="statusbox">
                            <h2>Sectors</h2>
                            <div class="statusbox-content">
                                <strong>
                                    <?php $data = $this->context->accessData();
                                    echo $data['get_places_with_empty_fields']['sectors']; ?>
                                </strong>
                                <span></span>
                            </div>

                            <div class="statusbox-actions">
                                <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-eye']), Yii::$app->request->baseUrl . '/place/list?attribute=sector', ['class' => '']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="statusbox">
                            <h2>Cell</h2>
                            <div class="statusbox-content">
                                <strong>
                                    <?php $data = $this->context->accessData();
                                    echo $data['get_places_with_empty_fields']['cells']; ?>
                                </strong>
                                <span></span>
                            </div>

                            <div class="statusbox-actions">
                                <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-eye']), Yii::$app->request->baseUrl . '/place/list?attribute=cell', ['class' => '']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-4">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="statusbox">
                            <h2>Neigh.</h2>
                            <div class="statusbox-content">
                                <strong>
                                    <?php $data = $this->context->accessData();
                                    echo $data['get_places_with_empty_fields']['neighborhoods']; ?>
                                </strong>
                                <span></span>
                            </div>

                            <div class="statusbox-actions">
                                <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-eye']), Yii::$app->request->baseUrl . '/place/list?attribute=neighborhood', ['class' => '']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="statusbox">
                            <h2>Street</h2>
                            <div class="statusbox-content">
                                <strong>
                                    <?php $data = $this->context->accessData();
                                    echo $data['get_places_with_empty_fields']['streets']; ?>
                                </strong>
                                <span></span>
                            </div>

                            <div class="statusbox-actions">
                                <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-eye']), Yii::$app->request->baseUrl . '/place/list?attribute=street', ['class' => '']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
