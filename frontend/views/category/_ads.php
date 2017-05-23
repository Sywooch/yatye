<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 5/15/17
 * Time: 5:01 PM
 */
?>

<div class="col-sm-6">
    <div class="card">
        <div class="carousel slide carousel-fade" data-interval="1500" data-ride="carousel"
             data-wrap="true">
            <div class="carousel-inner">
                <?php $active = ' active';
                foreach ($ads['300x300'] as $ad) :
                    if ($ad->image != '' || $ad->image != null) : ?>
                        <div class="item <?php echo $active; ?>">
                            <img style="width: 300px;height: 300px;"
                                 src="<?php echo $ad->getPath() ?>"
                                 alt="<?php echo $ad->title ?>">
                        </div>
                    <?php endif;
                    $active = null;
                endforeach; ?>
            </div>
        </div>
    </div>
</div>
