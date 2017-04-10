<?php
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = Yii::t('app', 'About us');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="">
    <?php echo $this->render('_left_side_about_us', [
        'about_us_posts' => $about_us_posts,
    ]) ?>

    <?php echo $this->render('_about', [
        'model' => $model,
    ]) ?>
</div>

