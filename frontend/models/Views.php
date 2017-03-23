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
            [['place_id'], 'exist', 'skipOnError' => true, 'targetClass' => Place::className(), 'targetAttribute' => ['place_id' => 'id']],];
    }

    public static function insertViews($place_id)
    {
        $views = Views::findOne(['place_id' => $place_id]);

        if (!empty($views)) {
            $model = $views;
        }else{
            $model = new Views();
        }

        $transaction = $model->getDb()->beginTransaction();
        try {

            if ($model->isNewRecord) {
                $model->place_id = $place_id;
                $model->status = Yii::$app->params['active'];
            }

            $model->views = $model->views + 1;
            $model->save();

            $views_list = new ViewsList();
            $views_list->views_id = $model->id;
            $views_list->ip_address = Yii::$app->request->getUserIP();
            $views_list->save();

            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
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