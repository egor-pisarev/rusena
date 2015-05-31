<?php
/**
 * Created by JetBrains PhpStorm.
 * User: egor
 * Date: 28.05.15
 * Time: 12:34
 * To change this template use File | Settings | File Templates.
 */

namespace app\modules\user\controllers;

use dektrium\user\controllers\AdminController as BaseController;

class AdminController extends BaseController {
   public $layout = '@easyii/views/layouts/main';
}