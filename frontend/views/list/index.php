<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = Yii::$app->name . ' - ' . $model->name;
$this->registerCss('
    .small-image img {width: 150px;}
    .small-content {margin-left: 170px;}
');
?>
<div class="container">
    <div class="row">
        <ol class="breadcrumb bread-primary" style="background: none;">
            <li><a href="<?php echo Yii::$app->request->baseUrl ?>"><?php echo Yii::$app->name; ?></a></li>
            <li class="active"><a href="<?php echo Url::to(['/category/' . $model->slug]) ?>"><?php echo $model->name ?></a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-sm-8 col-lg-9">
            <div class="content">
                <?php echo $this->render('/list/_free_list', [
                    'model' => $model,
                    'place_list' => $place_list,
                ]); ?>
            </div>
        </div>
        <?php echo $this->render('@app/views/layouts/_right_side') ?>
    </div>
</div>
