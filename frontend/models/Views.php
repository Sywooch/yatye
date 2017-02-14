<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 09/03/2016
 * Time: 18:41
 */

namespace frontend\models;

use Yii;
use common\models\Views as BaseViews;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\db\Query;

class Views extends BaseViews
{
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function rules()
    {
        return [
            [['place_id', 'views'], 'required'],
            [['place_id', 'status'], 'integer'],
            [['views'], 'number'],
            [['views'], 'default', 'value' => 0],
            [['place_id'], 'unique'],
            [['place_id'], 'exist', 'skipOnError' => true, 'targetClass' => Place::className(), 'targetAttribute' => ['place_id' => 'id']],
        ];
    }

    public static function insertViews($place_id)
    {

        $views = Views::findOne(['place_id' => $place_id]);



        try {
            if (!empty($views)) {
                $views->views = $views->views + 1;
//                $views->save(0);

                if ($views->save(0)) {
                    $views_list = new ViewsList();
                    $views_list->views_id = $views->id;
                    $views_list->view = 1;
                    $views_list->ip_address = Yii::$app->request->getUserIP();
                    $views_list->save(0);
                }

            } else {

                $model = new Views();

                $model->views = 1;
                $model->place_id = $place_id;
//                $model->id = Yii::$app->request->getUserIP();
                $model->status = Yii::$app->params['active'];
//                $model->save(0);

                if ($model->save(0)) {
                    $views_list = new ViewsList();
                    $views_list->views_id = $model->id;
                    $views_list->view = 1;
                    $views_list->ip_address = Yii::$app->request->getUserIP();
                    $views_list->save(0);
                }
            }
        } catch (\Exception $e) {

        }

    }

    public static function getViews()
    {
        $query = new  Query();
        return $query
            ->select('`views`.`id`')
            ->addSelect('`place`.`name`')
            ->addSelect('`views`.`views`')
            ->addSelect('`views`.`status`')
            ->addSelect('`views`.`updated_at`')
            ->from('`views`, `place`')
            ->where('`views`.`place_id` = `place`.`id`')
            ->orderBy(new Expression('`views`.`updated_at` DESC'))
            ->all();
    }
}