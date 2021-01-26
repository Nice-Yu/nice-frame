<?php
declare(strict_types=1);
/** 定义目录 */
define('appPath', __DIR__ . '/../');
define('appName', 'src');
define('debug', true);
if (debug) {
    ini_set('display_errors', 'On');
} else {
    ini_set('display_errors', 'Off');
}

/** 引入文件 */
include appPath . 'core/Frame.php';

/** 自动载入 */
spl_autoload_register('\core\Frame::loader');

/** 启动框架 */
\core\Frame::run();

function ps($var)
{
    ob_start();
    var_dump($var);
    $output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', ob_get_clean());
    if (!extension_loaded('xdebug')) {
        $output = htmlspecialchars($output, ENT_SUBSTITUTE);
    }
    $output = '<pre>' . $output . '</pre>';
    echo($output);
}