<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
use backend\assets\RwandaguideAsset;
RwandaguideAsset::register($this);

$this->title = 'Nearby Places';
?>
<div class="container">
    <div class="row">
        <ol class="breadcrumb bread-primary" style="background: none;">
            <li><a href="<?php echo Yii::$app->request->baseUrl ?>"><?php echo Yii::$app->name; ?></a></li>
            <li class="active"><a href="#">Nearby Places</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-sm-8 col-lg-9">
            <div class="content">
                <?php if(!empty($places)) : ?>
                <?php echo $this->render('/list/_basic_list', [
                    'place_list' => $places,
                ]); ?>

                <?php else : ?>
                    <div class="alert alert-info">
                    	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    	<strong>Not found!</strong> The system couldn't find nearby places based on selected category and your location!
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php echo $this->render('@app/views/layouts/_right_side') ?>
    </div>
</div>
