<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 11/07/2016
 * Time: 01:13
 */

$data = $this->context->accessData();
$ads = $data['get_ads'];
?>

<?php if (!empty($ads)): ?>
    <div class="col-sm-6 col-lg-4">
        <div style="margin-bottom: 30px;">
            <div class="carousel slide carousel-fade" data-interval="3000" data-ride="carousel"
                 data-wrap="true">
                <div class="carousel-inner">
                    <?php $active = ' active';
                    foreach ($ads['300x300'] as $ad) :
                        if ($ad->image != '' || $ad->image != null) : ?>
                            <div class="item <?php echo $active; ?>">
                                <img style="max-width: 235px;max-height: 200px;"
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
<?php endif; ?>