<?php
/**
 * Created by JetBrains PhpStorm.
 * User: egor
 * Date: 28.05.15
 * Time: 12:34
 * To change this template use File | Settings | File Templates.
 */

namespace app\modules\user\controllers;

use dektrium\user\controllers\RegistrationController as BaseController;

class RegistrationController extends BaseController {
    public $layout = '@app/themes/rusena/layouts/main';
}