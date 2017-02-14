<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Dashboard';
?>

<div class="container">
    <div class="row">
        <ol class="breadcrumb bread-primary" style="background: none;">
            <li><a href="<?php echo Yii::$app->request->baseUrl ?>"><?php echo Yii::$app->name; ?></a></li>
            <li class="active"><a href="<?php echo Url::to(['dashboard']) ?>"><?= Html::encode($this->title) ?></a></li>
        </ol>
    </div>
    <div class="row">
        <?php $data = $this->context->accessData(); echo $this->render('@app/views/layouts/_side_bar', ['data' => $data]); ?>
        <div class="col-sm-8 col-lg-9">
            <div class="row">

                <div class="background-white p30 mb50">
                    <div class="cards-system">
                        <?php  foreach($places as $place) : ?>

                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="card-system">
                                    <div class="card-system-inner">
                                        <div class="card-system-image"
                                             data-background-image="<?php echo Yii::$app->params['thumbnails'] . $place['logo'] ?>">
                                            <a href="<?php echo Yii::$app->request->baseUrl . '/place/' . $place['id'] . '/' . $place['slug'] ?>"></a>
                                        </div>

                                        <div class="card-system-content">
                                            <h2><a href="<?php echo Yii::$app->request->baseUrl . '/place/' . $place['id'] . '/' . $place['slug'] ?>"><?php echo $place['name'] ?></a></h2>
                                            <h3></h3>
                                            <a href="<?php echo Yii::$app->request->baseUrl . '/place/' . $place['id'] . '/' . $place['slug'] ?>" class="btn btn-primary btn-xs">Edit</a>
<!--                                            <a href="--><?php //echo Yii::$app->request->baseUrl . '/place/update/' . $place['id'] ?><!--" class="btn btn-secondary btn-xs">Edit</a>-->
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
