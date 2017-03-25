<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 3/25/17
 * Time: 8:18 PM
 */
?>

<div class="row mt30">
    <?php foreach ($ads['840x120'] as $ad) : ?>
        <?php if ($ad->image != '') : ?>
            <div class="col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
                <a href="<?php echo $ad->url ?>" target="_blank">
                    <img class="img-responsive div" src="http://placehold.it/840x120.png&text=Advertise Here"
                         alt="<?php echo $ad->title ?>">
                </a>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
