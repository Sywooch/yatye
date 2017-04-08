<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 04/01/2017
 * Time: 11:07
 */
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="col-sm-4 col-lg-3">
    <div class="sidebar mt50">
        <div class="widget">
            <h2 class="widgettitle"><?php echo Yii::t('app', 'About us') ?></h2>
            <?php if (!empty($about_us_posts)):?>
                <ul class="menu">
                    <?php foreach ($about_us_posts as $about_us_post): ?>
                        <li>
                            <a href="<?php echo $about_us_post->getPostUrl(); ?>">
                                <?php echo $about_us_post->title ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</div>
