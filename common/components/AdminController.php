<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 25/01/2016
 * Time: 21:06
 */

namespace common\components;

use backend\models\Contact;
use backend\models\Gallery;
use backend\models\PlaceService;
use backend\models\Post;
use backend\models\Place;
use backend\models\SocialMedia;
use common\helpers\GalleryHelper;
use common\helpers\Helpers;
use common\helpers\RecordHelpers;
use frontend\models\Views;
use Yii;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\UploadedFile;

class AdminController extends BaseController
{
    public $enableCsrfValidation = false;
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [
                    'index',
                    'create',
                    'update',
                    'view',
                    'delete',
                    'accept',
                    'activate-logo',
                    'activate',
                    'active',
                    'add-contacts',
                    'add-places',
                    'add-services',
                    'add-social-medial',
                    'cells',
                    'clean',
                    'customer-management',
                    'delete-gallery',
                    'delete-item',
                    'delete-post-picture',
                    'downgrade',
                    'download',
                    'gallery',
                    'list',
                    'logout',
                    'post-picture',
                    'publish',
                    'rate',
                    'reject',
                    'restore',
                    'sectors',
                    'send',
                    'set-basic-info',
                    'set-gallery',
                    'set-location',
                    'set-settings',
                    'set-users',
                    'syncdown',
                    'upload',
                    'profile-picture',
                    'update-user',
                    'import',
                ],
                'rules' => [
                    [
                        'actions' => [
                            'index',
                            'create',
                            'update',
                            'view',
                            'delete',
                            'accept',
                            'activate-logo',
                            'activate',
                            'active',
                            'add-contacts',
                            'add-places',
                            'add-services',
                            'add-social-medial',
                            'cells',
                            'clean',
                            'customer-management',
                            'delete-gallery',
                            'delete-item',
                            'delete-post-picture',
                            'downgrade',
                            'download',
                            'gallery',
                            'list',
                            'logout',
                            'post-picture',
                            'publish',
                            'rate',
                            'reject',
                            'restore',
                            'sectors',
                            'send',
                            'set-basic-info',
                            'set-gallery',
                            'set-location',
                            'set-settings',
                            'set-users',
                            'syncdown',
                            'update',
                            'upload',
                            'profile-picture',
                            'update-user',
                            'import',
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'logout' => ['post'],
                ],
            ],
        ];
    }

}