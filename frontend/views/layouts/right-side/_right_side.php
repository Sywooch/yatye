<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 4/3/17
 * Time: 12:51 AM
 */
?>
<div class="col-sm-4 col-lg-3 p30 visible-md visible-lg">
    <div class="sidebar" style="margin-top: -30px;">
        <?= $this->render('_upcoming_events', []) ?>
        <?= $this->render('_archives', []) ?>
        <?= $this->render('_filter', []) ?>
    </div>
</div>
