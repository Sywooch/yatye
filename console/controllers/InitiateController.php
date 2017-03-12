<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 21/05/2016
 * Time: 23:41
 */

namespace console\controllers;

use common\helpers\SitemapHelper;
use pendalf89\sitemap\SitemapGenerator;
use Yii;
use common\models\Place;
use common\models\WorkingHours;
use yii\console\Controller;

class InitiateController extends Controller
{

    public function actionWorkingHours()
    {

        $places = Place::find()->all();

        foreach ($places as $place) {
            $days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
            $rows = array();
            foreach ($days as $day) {
                $rows[] = [
                    'place_id' => $place->id,
                    'day' => $day,
                    'opening_time' => '08:00:00',
                    'closing_time' => '17:00:00',
                    'status' => 2,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => 1,
                    'updated_by' => 1,

                ];
            }

            $models = WorkingHours::findAll(['place_id' => $place->id]);

            if (!$models) {
                Yii::$app->db->createCommand()->batchInsert(WorkingHours::tableName(), ['place_id', 'day', 'opening_time', 'closing_time', 'status', 'created_at', 'created_by', 'updated_by'], $rows)->execute();
            }
        }
    }

    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        // add "Create" permission
        $create = $auth->createPermission('create');
        $create->description = 'Create Actions';
        $auth->add($create);

        // add "Update" permission
        $update = $auth->createPermission('update');
        $update->description = 'Update Actions';
        $auth->add($update);

        // add "Delete" permission
        $delete = $auth->createPermission('delete');
        $delete->description = 'Delete Actions';
        $auth->add($delete);

        // add "User" role and give this role the "Create" permission
        $user = $auth->createRole('User');
        $auth->add($user);
        $auth->addChild($user, $create);

        // add "Admin" role and give this role the "Update" permission
        $admin = $auth->createRole('Admin');
        $auth->add($admin);
        $auth->addChild($admin, $update);
        $auth->addChild($admin, $user);

        // add "Super Admin" role and give this role the "Delete" permission
        $super_admin = $auth->createRole('SuperAdmin');
        $auth->add($super_admin);
        $auth->addChild($super_admin, $delete);
        $auth->addChild($super_admin, $admin);

    }

    public function actionSitemap(){
        Yii::$app->urlManager->baseUrl = 'http://rwandaguide.info/'; // base url use in sitemap urls creation

        $sitemap = new SitemapHelper(); // must implement a SitemapInterface
        $sitemapGenerator = new SitemapGenerator([
            'sitemaps' => [$sitemap],
            'dir' => Yii::$app->params['frontend_alias'],
        ]);
        $sitemapGenerator->generate();
    }
}