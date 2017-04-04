<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = $model->name;
$this->params['breadcrumbs'][] = $model->name;

$dataProvider->pagination = [
    'pageSize' => 6,
];
?>
<div class="col-sm-8 col-lg-9">
    <div class="content">
        <div class="page-title">
            <h1><?php echo $model->name; ?></h1>
        </div>
        <?php if (!empty($post_categories)) : ?>
            <div class="row background-white p30 div">
                <ul class="list-inline">
                    <?php foreach ($post_categories as $post_category) : ?>
                        <li><a href="<?php echo $post_category->getUrl(); ?>">
                                <span class="badge" style="background-color: #c6af5c; font-size: 16px;">
                                    <?php echo $post_category->name; ?>
                                </span>
                            </a>
                            <br>
                            <br>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <br>
        <?php endif; ?>

        <div class="row">
            <div class="posts">
                <?= ListView::widget([
                    'options' => [
                        'tag' => 'div',
                    ],
                    'dataProvider' => $dataProvider,
                    'itemView' => function ($model, $key, $index, $widget) {

                        $itemContent = $this->render('_list_item', ['model' => $model]);

                        /* Display an Advertisement after the first list item */
                        /*if ($index == 5) {
                            $adContent = $this->render('_ad');
                            $itemContent .= $adContent;
                        }*/

                        return $itemContent;

                    },
                    'itemOptions' => [
                        'tag' => false,
                        'class' => 'item'
                    ],
                    'layout' => '{items}{pager}',

                    'pager' => [
                        'prevPageLabel' => false,
                        'nextPageLabel' => false,
                        'maxButtonCount' => 12,
                        'options' => [
                            'class' => 'pager col-xs-12'
                        ]
                    ],

                ]); ?>

            </div>
        </div>

    </div>
</div>
<?= $this->render('@app/views/layouts/right-side/_right_side', []) ?>
