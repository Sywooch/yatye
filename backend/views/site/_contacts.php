<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 5/9/17
 * Time: 4:30 PM
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
                            <h2>Addr.</h2>
                            <div class="statusbox-content">
                                <strong>
                                    <?php $data = $this->context->accessData();
                                    echo $data['get_places_without_contacts']['physical_addresses']; ?>
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
                            <h2>P. Box</h2>
                            <div class="statusbox-content">
                                <strong>
                                    <?php $data = $this->context->accessData();
                                    echo $data['get_places_without_contacts']['po_boxes']; ?>
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
                            <h2>Mob</h2>
                            <div class="statusbox-content">
                                <strong>
                                    <?php $data = $this->context->accessData();
                                    echo $data['get_places_without_contacts']['mob_phones']; ?>
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
                            <h2>Tel</h2>
                            <div class="statusbox-content">
                                <strong>
                                    <?php $data = $this->context->accessData();
                                    echo $data['get_places_without_contacts']['land_lines']; ?>
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
                            <h2>Email</h2>
                            <div class="statusbox-content">
                                <strong>
                                    <?php $data = $this->context->accessData();
                                    echo $data['get_places_without_contacts']['emails']; ?>
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
                            <h2>Web</h2>
                            <div class="statusbox-content">
                                <strong>
                                    <?php $data = $this->context->accessData();
                                    echo $data['get_places_without_contacts']['websites']; ?>
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
    </div>
</div>