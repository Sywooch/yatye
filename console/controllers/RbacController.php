<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 30/06/2016
 * Time: 23:47
 */

namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{

    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll(); //remove previous rbac.php files under console/data

        //CREATE PERMISSIONS

        //Permission to create users
        $createUsers = $auth->createPermission('create');
        $createUsers->description = 'Create Users';
        $auth->add($createUsers);

        //Permission to edit user profile
        $editUserProfile = $auth->createPermission('update');
        $editUserProfile->description = 'Update User Profile';
        $auth->add($editUserProfile);

        //APPLY THE RULE
        $rule = new UserRoleRule(); //Apply our Rule that use the user roles from user table
        $auth->add($rule);

        //ROLES AND PERMISSIONS

        //User role
        $user = $auth->createRole('User');  //user role
        $user->ruleName = $rule->name;
        $auth->add($user);

        //Admin role
        $admin = $auth->createRole('Admin');
        $admin->ruleName = $rule->name;
        $auth->add($admin);
        $auth->addChild($admin, $user);
        $auth->addChild($admin, $editUserProfile);

        //Super Admin role
        $super_admin = $auth->createRole('SuperAdmin');
        $super_admin->ruleName = $rule->name;
        $auth->add($super_admin);
        $auth->addChild($super_admin, $admin);
        $auth->addChild($super_admin, $createUsers);
    }
}