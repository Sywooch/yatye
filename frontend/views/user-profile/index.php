<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Profiles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-profile-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User Profile', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'place_id',
            'first_name',
            'last_name',
            // 'middle_name',
            // 'birthdate',
            // 'gender',
            // 'avatar',
            // 'bio:ntext',
            // 'email:email',
            // 'phone',
            // 'facebook',
            // 'twitter',
            // 'google_plus',
            // 'linkedin',
            // 'instagram',
            // 'created_at',
            // 'expire_at',
            // 'updated_at',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
