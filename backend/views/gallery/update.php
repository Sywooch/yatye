<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Gallery */

$this->title = $model->getPlaceName() . ' - ' . $model->getServiceName();
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Galleries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="background-white p20">
    <div class="row">
    	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
    		<div class="thumbnail">
                <img class="img-responsive" alt="" src="<?php echo Yii::$app->params['galleries'] . $model->name ?>"/>
    		</div>
    	</div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?= $this->render('_form', [
                'model' => $model,
                'categories' => $categories,
                'status' => $status,
            ]) ?>
        </div>
    </div>
</div>

