<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        $createRequest = $auth->createPermission('createRequest');
        $auth->add($createRequest);

        $approveRequest = $auth->createPermission('approveRequest');
        $auth->add($approveRequest);

        $manageMasterData = $auth->createPermission('manageMasterData');
        $auth->add($manageMasterData);

        $staff = $auth->createRole('staff');
        $auth->add($staff);

        $supervisor = $auth->createRole('supervisor');
        $auth->add($supervisor);

        $admin = $auth->createRole('admin');
        $auth->add($admin);

        $auth->addChild($staff, $createRequest);
        $auth->addChild($supervisor, $approveRequest);
        $auth->addChild($admin, $manageMasterData);

        $auth->addChild($supervisor, $staff);
        $auth->addChild($admin, $supervisor);

        echo "RBAC initialized!\n";
    }

    public function actionAssign($username, $role)
    {
        $auth = Yii::$app->authManager;
        $user = \common\models\User::findOne(['username' => $username]);

        if (!$user) {
            echo "User '$username' tidak ditemukan.\n";
            return;
        }

        $authRole = $auth->getRole($role);
        if (!$authRole) {
            echo "Role '$role' tidak ditemukan.\n";
            return;
        }

        $auth->revokeAll($user->id);
        $auth->assign($authRole, $user->id);

        echo "User '$username' di-assign role '$role'\n";
    }
}