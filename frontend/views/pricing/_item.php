<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 02/01/2017
 * Time: 19:40
 */
?>

<div class="col-sm-4 item" data-key="<?= $model['id'] ?>">
    <div class="pricing">
        <div class="pricing-title"  style="font-size: 30px;"><?= $model['title'] ?></div>
        <div class="pricing-subtitle" style="color: #c6af5c;"><?= $model['descriptions'] ?></div>
        <div class="pricing-price" style="font-size: 20px;">
            <span class="pricing-currency">RWF</span>
            <?= number_format($model['price'], 2) ?>
            <span class="pricing-period">/ 3 months</span>
        </div>
        <hr>
        <div class="pricing-price" style="font-size: 20px;">
            <span class="pricing-currency">RWF</span>
            <?= number_format($model['discount'], 2) ?>
            <span class="pricing-period">/ 12 months</span>
        </div>
        <?php $pricing_items = $model->getPricingItems(); if (!empty($pricing_items)) : ?>
        <hr>
        <ul class="pricing-list">
            <?php foreach ($pricing_items as $pricing_item): ?>
                <li><strong><?= $pricing_item['name']; ?></strong><span><?= $pricing_item['descriptions']; ?></span></li><br/>
            <?php endforeach; ?>
        </ul>
<!--        <hr>-->
<!--        <a href="#" class="pricing-action">Full List of Features</a>-->
        <?php endif; ?>
    </div>
</div>
