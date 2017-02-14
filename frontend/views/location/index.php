<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
$this->title = 'Location';
?>
<div class="container">
    <div class="block background-white fullwidth  mb-80">
        <div class="categories">
            <ul>
                <?php foreach ($districts as $district) : ?>
                <li>
                    <a href="#" class="categories-action"><?php echo $district['province_name'] ?></a>
                    <a href="<?php echo Url::to(['location/' . $district['name']]) ?>" class="categories-link"><?php echo $district['name'] ?></a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>

    </div>
</div>