<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 3/19/17
 * Time: 12:07 PM
 */
use yii\helpers\Html;

$data = $this->context->accessData();
$keywords = $data['get_keywords'];
?>

<title><?= Html::encode($this->title) ?></title>
<meta name="description" content="<?php echo Yii::$app->params['meta_description']; ?>">
<meta name="keywords" content="<?php echo $keywords; ?>">
<meta name="robots" content="all, index, follow"/>
<meta name="revisit-after" content="2 days">
<meta name="revisit" content="2 days"/>
<meta name="distribution" content="Global">
<!--<meta http-equiv="refresh" content="30">-->
<meta http-equiv="cache-control" content="no-cache"/>
<meta http-equiv="expires" content="30"/>
<meta name="google-site-verification" content="PSEIUTyoAIopuk7Q8t8B6M6WiF711Udi3dT1YE6LBFk"/>
<meta name="msvalidate.01" content="C8A5F2BA2975673A43AB130C098FB357" />
<meta name="yandex-verification" content="cce2a42742b85fc7" />

<meta name="serp-rank" position="1"/>
<meta name="serps" content="1, 2, 3, 10, 11, ATF"/>
<meta name="alexa" content="100"/>
<meta name="googlebot" content="all, index, follow, none, noindex, nofollow, noarchive, nosnippet"/>
<meta name="pagerank™" content="10"/>
