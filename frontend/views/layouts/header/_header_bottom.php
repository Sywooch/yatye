<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 3/19/17
 * Time: 10:30 AM
 */
use yii\helpers\Url;
use yii\helpers\Html;

?>
<ul class="header-nav-primary nav nav-pills collapse navbar-collapse">
    <?php $data = $this->context->accessData();
    $categories = $data['all_categories'];
    foreach ($categories as $category): ?>
        <li><a href="<?php echo Url::to(['/category/' . $category->slug]) ?>"><?php echo $category->name ?></a></li>
    <?php endforeach; ?>
    <?php //echo $this->render('@app/views/layouts/header/mega_menu') ?>
</ul>
<button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".header-nav-primary">
    <span class="sr-only">Toggle navigation</span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
</button>
