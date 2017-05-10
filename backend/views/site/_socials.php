<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 5/9/17
 * Time: 4:44 PM
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
                            <h2>FB.</h2>
                            <div class="statusbox-content">
                                <strong>
                                    <?php $data = $this->context->accessData();
                                    echo $data['get_places_without_social_media']['facebook']; ?>
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
                            <h2>Twitter</h2>
                            <div class="statusbox-content">
                                <strong>
                                    <?php $data = $this->context->accessData();
                                    echo $data['get_places_without_social_media']['twitter']; ?>
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
                            <h2>Instagram</h2>
                            <div class="statusbox-content">
                                <strong>
                                    <?php $data = $this->context->accessData();
                                    echo $data['get_places_without_social_media']['instagram']; ?>
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
                            <h2>Linkedin</h2>
                            <div class="statusbox-content">
                                <strong>
                                    <?php $data = $this->context->accessData();
                                    echo $data['get_places_without_social_media']['linkedin']; ?>
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
                            <h2>Google</h2>
                            <div class="statusbox-content">
                                <strong>
                                    <?php $data = $this->context->accessData();
                                    echo $data['get_places_without_social_media']['google_plus']; ?>
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
                            <h2>T. Adv</h2>
                            <div class="statusbox-content">
                                <strong>
                                    <?php $data = $this->context->accessData();
                                    echo $data['get_places_without_social_media']['trip_advisor']; ?>
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


