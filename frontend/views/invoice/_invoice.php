<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

    <link href="http://fonts.googleapis.com/css?family=Nunito:300,400,700" rel="stylesheet" type="text/css">
    <link href="../../../dist/superlist/libraries/font-awesome/css/font-awesome.min.css" rel="stylesheet"
          type="text/css">
    <link href="../../../dist/superlist/libraries/bootstrap-fileinput/fileinput.min.css" rel="stylesheet"
          type="text/css">
    <link href="../../../dist/superlist/css/superlist.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="page-wrapper">
    <div class="main">
        <div class="main-inner">
            <div class="container">
                <div class="content">
                    <div class="invoice-wrapper div">
                        <div class="invoice">
                            <div class="invoice-header clearfix">
                                <div class="invoice-logo">
                                    <img style="width: 128px;" src="<?= Yii::$app->params['logo_320'] ?>"
                                         alt="<?php echo Yii::$app->name ?>" title="<?php echo Yii::$app->name ?>">
                                </div>

                                <div class="invoice-description">
                                    <strong><?php echo Yii::t('app', 'Invoice') ?>
                                        #<?php echo $model->id . '-' . $model->getMaxInvoiceNumber() ?>
                                        / <?php echo $model->getDate() ?></strong>
                                </div>
                            </div>

                            <div class="invoice-info">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h4><?php echo Yii::t('app', 'Client') ?></h4>

                                        <?php echo Yii::t('app', 'Name') ?>: <?php echo $client->name ?><br>
                                        <?php echo Yii::t('app', 'TIN') ?>: <?php echo $client->tin ?><br>
                                        <?php echo Yii::t('app', 'Address') ?>: <?php echo $client->address ?><br>
                                        <?php echo Yii::t('app', 'Phone') ?>: <?php echo $client->phone ?><br>
                                    </div>

                                    <div class="col-sm-4">
                                        <h4><?php echo Yii::t('app', 'Notice') ?></h4>

                                        <?php echo Yii::t('app', 'In case of delays on invoice payment, Rwanda Guide reserves the right to suspend the service') ?>
                                        <br>
                                    </div>
                                    <div class="col-sm-4">
                                        <h4><?php echo Yii::t('app', 'Payment Details') ?></h4>
                                        <strong><?php echo Yii::t('app', 'Payment Type') ?>
                                            :</strong> <?php echo $model->getTypes() ?><br>
                                        <strong><?php echo Yii::t('app', 'Duration') ?>
                                            :</strong> <?php echo $contract->getPeriod() ?><br>
                                    </div>
                                </div>
                            </div>
                            <?php $i = 1;
                            if (!empty($invoice_items)) :
                                $subtotal = 0.0;
                                $total = 0.0;
                                $discount = 0.0;
                                ?>
                                <table class="invoice-table table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?php echo Yii::t('app', 'Item') ?></th>
                                        <th><?php echo Yii::t('app', 'Quantity') ?></th>
                                        <th><?php echo Yii::t('app', 'Unit Cost') ?></th>
                                        <th><?php echo Yii::t('app', 'Total') ?></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php foreach ($invoice_items as $invoice_item) :
                                        $subtotal += $invoice_item->total;
                                        ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $invoice_item->name ?></td>
                                            <td><?php echo $invoice_item->quantity ?></td>
                                            <td><?php echo $invoice_item->unit_cost ?> Rwf</td>
                                            <td><?php echo $invoice_item->total ?> Rwf</td>
                                        </tr>
                                        <?php $i++; endforeach; ?>
                                    </tbody>
                                </table>
                                <div class="invoice-summary clearfix">
                                    <dl class="dl-horizontal pull-right">
                                        <?php
                                        $discount = ($model->discount * $subtotal) / 100;
                                        $total = $subtotal - $discount;
                                        ?>
                                        <dt><?php echo Yii::t('app', 'Subtotal') ?>:</dt>
                                        <dd><?php echo number_format($subtotal, 2) ?> Rwf</dd>
                                        <dt><?php echo Yii::t('app', 'Discount') ?>:</dt>
                                        <dd><?php echo $discount ?> Rwf</dd>
                                        <dt><?php echo Yii::t('app', 'Total') ?>:</dt>
                                        <dd><?php echo number_format($total, 2) ?> Rwf</dd>
                                    </dl>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>







