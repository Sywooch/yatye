<?php
/* @var $this yii\web\View */

$this->title = $model->name . ' in Rwanda';
?>

<!--Premium List-->
<?php echo $this->render('_premium', [
    'model' => $model,
    'premium_places' => $premium_places,
    'services' => $services,
    'recent_added_places' => $recent_added_places,
    'get_most_viewed' => $get_most_viewed,
    'dataProvider' => $premiumListDataProvider,
]); ?>

<!--Advertisement Banners-->

<div class="block background-white mt30 p30 row div">
    <div class="page-header">
        <h1><?php echo Yii::t('app', 'Advertisement') ?></h1>
    </div>
    <?php $ads = $this->context->getAds();
    if (!empty($ads)) : echo $this->render('@app/views/site/_ads', [
        'ads' => $ads,
    ]); endif; ?>
</div>




<!--Basic List-->
<?php echo $this->render('_basic', [
    'model' => $model,
    'basic_places' => $basic_places,
    'dataProvider' => $basicListDataProvider,
]); ?>

<!--Articles-->
<?php echo $this->render('_articles', [
    'model' => $model,
    'articles' => $articles,
    'news' => $news,
]); ?>

<!--Free List-->
<?php echo $this->render('_free', [
    'model' => $model,
    'free_places' => $free_places,
    'dataProvider' => $freeListDataProvider,
]); ?>

