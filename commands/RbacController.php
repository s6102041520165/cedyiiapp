<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use Yii;

class RbacController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionHello($message = 'hello world')
    {
        echo $message . "\n";

        return ExitCode::OK;
    }

    public function actionCreatePermission()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
        echo('Removing All! RBAC.....');

        $manageUser = $auth->createRole('ManageUser');
        $manageUser->description = 'สำหรับจัดการข้อมูลผู้ใช้งาน';
        $auth->add($manageUser);

        $author = $auth->createRole('Author');
        $author->description = 'สำหรับการเขียนบทความ';
        $auth->add($author);

        $management = $auth->createRole('Management');
        $management->description = 'สำหรับจัดการข้อมูลผู้ใช้งานและบทความ';
        $auth->add($management);

        $admin = $auth->createRole('Admin');
        $admin->description = 'สำหรับการดูแลระบบ';
        $auth->add($admin);

        $auth->addChild($management, $manageUser);
        $auth->addChild($management, $author);
        $auth->addChild($admin, $management);

        $auth->assign($admin, 1);
        $auth->assign($management, 2);
        $auth->assign($author, 3);

        echo('Success! RBAC roles has been added.');

    }

    public function actionCreateRole()
    {
       //yii rbac/create-role
       $auth = Yii::$app->authManager;
        
       // post
       $post_index = $auth->createPermission('post/index');
       $post_create = $auth->createPermission('post/create');
       $post_update = $auth->createPermission('post/update');
       $post_delete = $auth->createPermission('post/delete');
       $post_view = $auth->createPermission('post/view');
       
       $user = $auth->createRole('user');
       $auth->add($user);
       $auth->addChild($user, $post_index);
       $auth->addChild($user, $post_view);
       
       $staff = $auth->createRole('staff');
       $auth->add($staff);
       $auth->addChild($staff, $post_create);
       $auth->addChild($staff, $user);
       
       $admin = $auth->createRole('admin');
       $auth->add($admin);
       $auth->addChild($admin, $post_update);
       $auth->addChild($admin, $post_delete);
       $auth->addChild($admin, $staff);
       echo 'Create Role success!';
    }
}
