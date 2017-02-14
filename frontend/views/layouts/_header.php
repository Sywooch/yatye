<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 12/12/2015
 * Time: 23:12
 */
use yii\helpers\Url;
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\form\ActiveForm;
use yii\base\View;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;

?>
    <header class="header">
        <div class="header-wrapper">
            <div class="container">
                <div class="header-inner">
                    <div class="header-logo">
                        <a href="<?php echo Yii::$app->params['root'] ?>">
                            <img
                                style='width: 192px; "Helvetica Neue", Helvetica, Arial, sans-serif; color: #5d4942; font-size: 24px;'
                                src="<?php echo Yii::$app->params['logo_320'] ?>"
                                alt="<?php echo Yii::$app->name ?>" title="<?php echo Yii::$app->name ?>">
                        </a>
                    </div>
                    <div class="header-content">
                        <div class="header-top">
                            <ul class="header-nav-secondary nav nav-pills">
                                <li><?php echo Html::a('About Rwanda', Url::to(['/articles/about-rwanda'])) ?></li>
                                <li><?php echo Html::a('Rwanda for the first time', Url::to(['/articles/before-you-make-the-move'])) ?></li>
                                <li><?php echo Html::a('News', Url::to(['/post-type/news'])) ?></li>
                                <li><a href="https://www.eyeem.com/u/rwandaguide" target="_blank" title="Gallery">Gallery</a></li>
<!--                                <li>--><?php //echo Html::a('Blog', Url::to(['/blog/'])) ?><!--</li>-->
                                <?php if (Yii::$app->user->isGuest) { ?>
                                    <li><?php echo Html::a(Yii::t('app', 'Login'), ['/user/security/login']) ?></li>
                                <?php } else { ?>
                                    <li><?php echo Html::a(Yii::$app->user->identity->username, ['/dashboard']) ?></li>
                                <?php } ?>
                            </ul>



                            <ul class="header-nav-social social-links nav nav-pills">
                                <li><a href="<?php echo Yii::$app->params['twitter'] ?>" target="_blank"
                                       title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="<?php echo Yii::$app->params['facebook'] ?>" target="_blank"
                                       title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="<?php echo Yii::$app->params['google-plus'] ?>" target="_blank"
                                       title="Google plus"><i class="fa fa-google-plus"></i></a></li>
<!--                                <li><a href="--><?php //echo Yii::$app->params['linkedin'] ?><!--" target="_blank"-->
<!--                                       title="Linkedin"><i class="fa fa-linkedin"></i></a></li>-->
                                <li><a href="<?php echo Yii::$app->params['tumblr'] ?>" target="_blank"
                                       title="Tumblr"><i class="fa fa-tumblr"></i></a></li>
                                <li><a href="<?php echo Yii::$app->params['instagram'] ?>" target="_blank"
                                       title="Instagram"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="<?php echo Yii::$app->params['pinterest'] ?>" target="_blank"
                                       title="Pinterest"><i class="fa fa-pinterest-p"></i></a></li>
                                <li><a href="<?php echo Yii::$app->params['flickr'] ?>" target="_blank"
                                       title="Flickr"><i class="fa fa-flickr"></i></a></li>
                                <li><a href="<?php echo Yii::$app->params['youtube'] ?>" target="_blank"
                                       title="Youtube"><i class="fa fa-youtube" style="background-color: #e62117;"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="header-bottom">
                            <div class="header-action">
                                <?php if(Yii::$app->controller->id == 'blog' || Yii::$app->controller->id == 'my-blog') :?>
                                    <a href="<?php echo Yii::$app->request->baseUrl ?>/my-blog/create"
                                       class="header-action-inner"
                                       title="Create a blog"
                                       data-toggle="tooltip" data-placement="bottom">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                <?php else: ?>
                                    <a href="<?php echo Yii::$app->request->baseUrl ?>/place/create"
                                       class="header-action-inner"
                                       title="Add a new place"
                                       data-toggle="tooltip" data-placement="bottom">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
<!--                            <div class="header-action">-->
<!--                                <a href="--><?php //echo Yii::$app->request->baseUrl ?><!--/location"-->
<!--                                   class="header-action-inner"-->
<!--                                   title="Search by location"-->
<!--                                   data-toggle="tooltip" data-placement="bottom">-->
<!--                                    <i class="fa fa-search"></i>-->
<!--                                </a>-->
<!--                            </div>-->

                            <ul class="header-nav-primary nav nav-pills collapse navbar-collapse">
                                <?php

                                $data = $this->context->accessData();
                                $categories = $data['all_categories'];

                                foreach ($categories as $category): ?>
                                    <li>
                                        <a href="<?php echo Url::to(['/category/' . $category->slug]) ?>"><?php echo $category->name ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>

                            <button class="navbar-toggle collapsed" type="button" data-toggle="collapse"
                                    data-target=".header-nav-primary">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

<?php

//$place = $this->context->getPlace();
//
//$categories = ArrayHelper::map($this->context->getAllCategories(), 'id', 'name');
//$provinces = ArrayHelper::map($this->context->getProvinces(), 'id', 'name');
//
//$services = $this->context->getServices($place->category_id);
//$districts = $this->context->getDistricts($place->province_id);
//$sectors = $this->context->getSectors($place->district_id);
//
//$services_in_array = $this->context->getDataInArray($services);
//$districts_in_array = $this->context->getDataInArray($districts);
//$sectors_in_array = $this->context->getDataInArray($sectors);

//$form = ActiveForm::begin(['options' => ['class' => 'filter'], 'action' => Url::to(['nearby-places/search']),]) ?>
    <!--    <div class="row">-->
    <!--        <div class="col-sm-12 col-md-4">-->
    <!--            <div class="form-group">-->
    <!--                --><? //= $form->field($place, 'name')->textInput([
//                    'maxlength' => true,
//                    'placeholder' => 'Name of a place',
//                ])->label(false) ?>
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="col-sm-12 col-md-2">-->
    <!--            <div class="form-group">-->
    <!---->
    <!--                --><?php //echo $form->field($place, 'category_id')->dropDownList($categories, [
//                    'id' => 'category_id',
//                    'prompt' => 'Category',
//                    'class' => 'input-xs'
//                ])->label(false); ?>
    <!---->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="col-sm-12 col-md-2">-->
    <!--            <div class="form-group">-->
    <!--                --><?php //echo $form->field($place, 'service_id')->widget(DepDrop::className(), [
//                    'options' => ['id' => 'service_id'],
//                    'data' => $services_in_array,
//                    'pluginOptions' => [
//                        'depends' => ['category_id'],
//                        'placeholder' => Yii::t('app', 'Services'),
//                        'url' => Url::to(['/nearby-places/services'])
//                    ]
//                ])->label(false); ?>
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="col-sm-12 col-md-2">-->
    <!--            <div class="form-group">-->
    <!--                --><?php //echo $form->field($place, 'province_id')->dropDownList($provinces, [
//                    'id' => 'province_id',
//                    'prompt' => 'Province',
//                    'class' => 'input-xs'
//                ])->label(false); ?>
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="col-sm-12 col-md-2">-->
    <!--            <div class="form-group">-->
    <!--                --><?php //echo $form->field($place, 'district_id')->widget(DepDrop::className(), [
//                    'options' => ['id' => 'district_id'],
//                    'data' => $districts_in_array,
//                    'pluginOptions' => [
//                        'depends' => ['province_id'],
//                        'placeholder' => Yii::t('app', 'Districts'),
//                        'url' => Url::to(['/nearby-places/districts'])
//                    ]
//                ])->label(false); ?>
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--    <hr>-->
    <!--    <div class="row">-->
    <!--        <div class="col-sm-4 pull-right">-->
    <!--            --><? //= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
    <!--        </div>-->
    <!--    </div>-->
<?php //ActiveForm::end(); ?>

<?php
$this->registerJs(
    '$(document).ready(function(){
        $("#distance").change(function(){
            var e = document.getElementById("distance");
            var e1 = document.getElementById("category_id");
            var strSel =  e.options[e.selectedIndex].value;
            var strSel1 =  e1.options[e1.selectedIndex].value;
            if(strSel1 !=""){
                window.location.href="' . Yii::$app->urlManager->createUrl('/nearby-places/?distance=" + strSel + "&category_id=') . '" + strSel1;
            }
            else{
                alert("Category is not selected!")
            }
        });
    });');
?>