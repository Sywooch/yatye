<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 27/01/2016
 * Time: 17:22
 */
/* @var $this yii\web\View */
$this->title = 'Add Services';
$this->registerCss("
.searchable-container{margin:20px 0 0 0}
.searchable-container label.btn-default.active{background-color:#5d4942;color:#FFF}
.searchable-container label.btn-default{width:90%;border:1px solid #efefef;margin:5px; box-shadow:5px 8px 8px 0 #ccc;}
.searchable-container label .bizcontent{width:100%;}
.searchable-container .btn-group{width:90%}
.searchable-container .btn span.glyphicon{
    opacity: 0;
}
.searchable-container .btn.active span.glyphicon {
    opacity: 1;
}")
?>
    <div class="row">
        <div class="col-sm-12">
            <div class="background-white p20">
<!--                --><?php //echo Html::a(Html::tag('i', '', ['class' => 'fa fa-chevron-circle-left']), Yii::$app->request->baseUrl .'/place/view?id=' . $place_id, ['class' => ['btn btn-primary'], 'title' => 'Back']) ?>
                <?php ActiveForm::begin(); ?>
                <div class="row">
<!--                    <h2>--><?php //echo $this->title; ?><!--</h2>-->
                    <div class="form-group">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <input type="search" class="form-control" id="search" placeholder="Add your options..">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="searchable-container">
                            <?php if (!empty($services)): ?>
                                <?php foreach ($services as $service): ?>
                                    <div class="items col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <div class="info-block block-info clearfix">
                                            <div class="square-box pull-left">
                                                <span class="glyphicon glyphicon-tags glyphicon-lg"></span>
                                            </div>
                                            <div data-toggle="buttons" class="btn-group bizmoduleselect">
                                                <label class="btn btn-default">
                                                    <div class="bizcontent">
                                                        <input type="checkbox" name="services[]" autocomplete="off" value="<?php echo $service->id ?>">
                                                        <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                                        <p><?php echo $service->name ?></p>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group" style="margin-top: 40px;">
                            <button type="submit" name="add_service" class="btn btn-primary btn-block">Save services</button>
                        </div>

                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
<?php $this->registerJs("$(function() {
    $('#search').on('keyup', function() {
        var pattern = $(this).val();
        $('.searchable-container .items').hide();
        $('.searchable-container .items').filter(function() {
            return $(this).text().match(new RegExp(pattern, 'i'));
        }).show();
    });
});") ?>