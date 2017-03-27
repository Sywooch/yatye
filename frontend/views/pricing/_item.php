<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 02/01/2017
 * Time: 19:40
 */
?>

<div class="col-sm-4 item" data-key="<?php echo $model['id'] ?>">
    <div class="pricing">
        <div class="pricing-title"  style="font-size: 30px;"><?php echo $model['title'] ?></div>
        <div class="pricing-subtitle" style="color: #c6af5c;"><?php echo $model['descriptions'] ?></div>

        <?php if (number_format($model['price'], 0) > 0): ?>
            <div class="pricing-price" style="font-size: 20px;">
                <span class="pricing-currency">Cost: </span>
                <span class="pricing-period"><a style="text-decoration: underline" target="_blank" href="http://rwandaguide.info/contact-us">Contact Us</a></span>
            </div>
        <?php else: ?>
            <div class="pricing-price" style="font-size: 20px;">
                <span class="pricing-currency">Cost: </span>
                <span class="pricing-period">Free</span>
            </div>
        <?php endif; ?>


<!--        <div class="pricing-price" style="font-size: 20px;">-->
<!--            <span class="pricing-currency">RWF</span>-->
<!--            --><?php //echo number_format($model['price'], 2) ?>
<!--            <span class="pricing-period">/ 3 months</span>-->
<!--        </div>-->
<!--        <hr>-->
<!--        <div class="pricing-price" style="font-size: 20px;">-->
<!--            <span class="pricing-currency">RWF</span>-->
<!--            --><?php //echo number_format($model['discount'], 2) ?>
<!--            <span class="pricing-period">/ 12 months</span>-->
<!--        </div>-->
        <?php $pricing_items = $model->getPricingItems(); if (!empty($pricing_items)) : ?>
        <hr>
        <ul class="pricing-list">
            <?php foreach ($pricing_items as $pricing_item): ?>
                <li><strong><?php echo $pricing_item['name']; ?></strong><span><?php echo $pricing_item['descriptions']; ?></span></li><br/>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    </div>
</div>
