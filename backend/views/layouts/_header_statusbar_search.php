<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 3/26/17
 * Time: 1:03 PM
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use kartik\form\ActiveForm;
use kartik\widgets\Typeahead;
?>

<?php if (
    Yii::$app->controller->id != 'role'
    && Yii::$app->controller->id != 'permission'
    && Yii::$app->controller->id != 'admin'
    && Yii::$app->controller->id != 'post'
    && Yii::$app->controller->id != 'articles'
): ?>

    <?php $data = $this->context->accessData();
    $place_model = $data['place_model'];
    $all_places = $data['get_all_places']; ?>

    <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_INLINE, 'action' => Yii::$app->request->baseUrl . '/place']) ?>

    <div class="form-group">
        <?php $place_names = array();
        foreach ($all_places as $place): array_push($place_names, $place->name); endforeach;

        echo $form->field($place_model, 'name')->widget(Typeahead::classname(), [
            'options' => ['placeholder' => 'Search by name', 'style' => ['width' => '300px'],],
            'pluginOptions' => ['highlight' => true,],
            'dataset' => [['local' => $place_names, 'limit' => 10],]
        ])->label(false); ?>
    </div>
    <div class="form-group">
        <?php echo Html::submitButton(Html::tag('span', '', ['class' => 'fa fa-search']), [
            'class' => ['btn btn-secondary btn-md', 'pull-right'],
            'style' => ['margin-left' => '-20px',],
        ]) ?>
    </div>
    <?php ActiveForm::end(); ?>

<?php endif; ?>
