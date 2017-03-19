<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 12/12/2015
 * Time: 23:12
 */
use yii\helpers\Url;
use yii\helpers\Html;

?>
<header class="header">
    <div class="header-wrapper">
        <div class="container">
            <div class="header-inner">
                <div class="header-logo">
                    <?php echo $this->render('@app/views/layouts/header/_header_logo') ?>
                </div>
                <div class="header-content">
                    <div class="header-top">
                        <?php echo $this->render('@app/views/layouts/header/_header_top') ?>
                    </div>
                    <div class="header-bottom">
                        <div class="header-action">
                            <?php echo $this->render('@app/views/layouts/header/_header_filter') ?>
                        </div>
                        <?php echo $this->render('@app/views/layouts/header/_header_bottom') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
