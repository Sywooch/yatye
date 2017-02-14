<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="row">
    <div class="caution">
        <h2><?= Html::encode($this->title) ?></h2>
        <h4><?= nl2br(Html::encode($message)) ?></h4>
    </div>
</div>
