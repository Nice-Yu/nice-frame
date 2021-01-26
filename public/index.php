<?php
declare(strict_types=1);

/** 定义路径 */
define('appPath', __DIR__ . '/../');

/** 项目名称 */
define('appName', 'src');

/** debug 信息 */
define('debug', true);
if (debug) {
    ini_set('display_errors', 'On');
} else {
    ini_set('display_errors', 'Off');
}

/** 引入框架 */
include appPath . 'core/Frame.php';

/** 引入 loader */
spl_autoload_register('\core\Frame::loader');

/** 执行框架 */
\core\Frame::run();