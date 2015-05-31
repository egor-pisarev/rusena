<?php
/**
 * Created by JetBrains PhpStorm.
 * User: egor
 * Date: 28.05.15
 * Time: 12:34
 * To change this template use File | Settings | File Templates.
 */

namespace app\modules\user\controllers;

use dektrium\user\controllers\SecurityController as BaseController;

class SecurityController extends BaseController {
   public $layout = '@app/themes/rusena/layouts/main';
}