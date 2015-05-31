<?php
/**
 * Created by JetBrains PhpStorm.
 * User: egor
 * Date: 28.05.15
 * Time: 12:06
 * To change this template use File | Settings | File Templates.
 */

namespace app\modules\user\models;

use dektrium\user\models\User as BaseUser;

class User extends BaseUser
{
    public function isRoot()
    {
        return true;
    }
}