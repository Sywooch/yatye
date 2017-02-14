<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 13/03/2016
 * Time: 09:18
 */

namespace backend\models;

use common\models\AuthAssignment;
use Yii;
use common\models\User as BaseUser;

class User extends BaseUser
{


    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    public function isSuperAdmin()
    {
        $role = AuthAssignment::findOne(['item_name' => ['SuperAdmin','Admin'], 'user_id' => $this->id]);

        if(!empty($role)){

            return true;
        }
        else{
            return false;
        }

    }
}