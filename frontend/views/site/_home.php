<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 5/11/17
 * Time: 1:48 PM
 */
use yii\helpers\Url;
?>

<div class="container">
    <div id="directory" class="block background-white p30 mt30 row div">
        <div class="cards-wrapper ">
            <div class="row grid">
                <div class="col-xs-12 col-sm-4 item">
                    <div class="text-justify" style="height: 300px; margin: 0 0 10px;">
                        <h1 style="font-size: 20px;"
                            class="text-center"><?php echo Yii::t('app', 'Have you ever been to Rwanda?') ?></h1>

                        <p class="text-center"><?php echo Yii::t('app', 'Want to visit and don\'t know where to start?') ?>
                            <br> <?php echo Yii::t('app', 'Don\'t worry, we got your back.') ?></p>
                        <p><?php echo Yii::t('app', 'It will help ease the stress of visiting a new country,
                            and it will assist you in making use of your precious time here in our
                            country. We hope you have a memorable time in our great country of Rwanda.') ?></p>
                        <p class="text-center" style="color: #000000;">
                            <i><b><?php echo Yii::t('app', 'Enjoy the wonderful land of a thousand hills!') ?></b></i>
                        </p>
                    </div>
                </div>
                <?php if (!empty($service_categories)):foreach ($service_categories as $category): ?>
                    <div class="col-xs-12 col-sm-4 item">
                        <div class="card" data-background-image="<?php echo $category->getGalleries() ?>">
                            <div class="card-content">
                                <h2>
                                    <a href="<?php echo Url::to(['/category/' . $category->slug]) ?>">
                                        <?php echo $category->name ?>
                                    </a>
                                </h2>
                                <div class="card-actions">
                                    <a href="<?php echo Url::to(['/category/' . $category->slug]) ?>"
                                       class="fa fa-eye"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;endif; ?>
            </div>
        </div>
    </div>
</div>
