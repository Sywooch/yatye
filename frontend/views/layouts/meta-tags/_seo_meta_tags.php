<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 3/19/17
 * Time: 12:07 PM
 */
use yii\helpers\Html;

$keywords = $this->context->getKeywords();
$date = strtotime("+7 day");
?>

<title><?= Html::encode($this->title) ?></title>
<meta name="description" content="<?php echo Yii::$app->params['meta_description']; ?>">
<meta name="keywords" content="<?php echo $keywords; ?>">
<meta name="distribution" content="global">

<meta name="revisit-after" content="7 days">
<meta name="expires" content="<?php echo date('D, d M Y', $date); ?>">

<meta name="robots" content="index, follow"/>
<meta name="googlebot" content="index, follow"/>
<meta name="google-site-verification" content="PSEIUTyoAIopuk7Q8t8B6M6WiF711Udi3dT1YE6LBFk"/>
<meta name="google" content="nositelinkssearchbox" />
<meta name="google" content="notranslate" />

<meta name="msvalidate.01" content="C8A5F2BA2975673A43AB130C098FB357" />
<meta name="yandex-verification" content="cce2a42742b85fc7" />

<!--<meta name="serp-rank" position="1"/>-->
<!--<meta name="serps" content="1, 2, 3, 10, 11, ATF"/>-->
<!--<meta name="alexa" content="100"/>-->
<!--<meta name="pagerank™" content="10"/>-->