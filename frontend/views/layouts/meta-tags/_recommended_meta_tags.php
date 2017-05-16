<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 3/19/17
 * Time: 12:08 PM
 */
use yii\helpers\Html;

$data = $this->context->accessData();
$keywords = $data['get_keywords'];
?>
<meta charset="<?= Yii::$app->charset ?>">
<meta name="language" content="english">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="author" content="Marius Ngaboyamahina"/>
<meta name="publisher" content="Marius Ngaboyamahina">
<meta name="no-email-collection" content="http://www.unspam.com/noemailcollection/">


<!--Optional Meta Tags-->
<meta name="title" content="<?= Html::encode($this->title) ?>">
<meta name="subject" content="<?php echo Yii::$app->params['meta_description']; ?>">
<meta name="abstract" content="<?php echo Yii::$app->params['meta_description']; ?>">
<meta name="web_author" content="Marius Ngaboyamahina">
<meta name="author" content="Marius Ngaboyamahina">
<meta name="rating" content="general">
<meta name="classification" content="<?php echo $keywords; ?>">
<meta name="copyright" content="Copyright <?php echo date('Y') ?> - <?php echo Yii::$app->name ?>">
<meta name="reply-to" content="rwandaguide.info@gmail.com">
<meta name="city" content="Kigali">
<meta name="country" content="Rwanda">
<meta name="geography" content="Rwanda Kigali">
<meta name="rating" content="general">

<!--Meta Tags for HTML pages on Mobile-->
<meta name="format-detection" content="telephone=yes"/>
<meta name="HandheldFriendly" content="true"/>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!--http-equiv Tags-->
<meta http-equiv="Cache-control" content="public">
<meta http-equiv="expires" content="30"/>
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Script-Type" content="text/javascript">

