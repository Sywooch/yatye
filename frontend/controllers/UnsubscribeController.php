<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 12/12/2016
 * Time: 00:14
 */

namespace frontend\controllers;

use backend\models\Subscription;
use Yii;

use common\components\BaseController;

class UnsubscribeController extends BaseController
{
    public function actionIndex()
    {
        $type = Yii::$app->request->get('type');

        $subscriber = Subscription::findOne(Yii::$app->request->get('id'));

        if ($type == 'visitors') {
            $subscriber->visitor = 0;
        } elseif ($type == 'users') {
            $subscriber->user = 0;
        } elseif ($type == 'places') {
            $subscriber->place = 0;
        } elseif ($type == 'all') {
            $subscriber->place = 0;
            $subscriber->visitor = 0;
            $subscriber->user = 0;
        }

        if ($subscriber->save()) {

            Yii::$app->getSession()->setFlash("success", Yii::t('app', 'We just received your request to unsubscribe for our newsletter emails and you won\'t get any more.'));
        }

        return $this->redirect(Yii::$app->params['root']);
    }
}