<?php
declare(strict_types=1);

if (!function_exists('ps')) {

    /**
     * 美化打印
     * @param $var
     */
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
}

if (!function_exists('config')) {

    /**
     * 获取配置
     * @param string $name
     * @return false|mixed
     */
    function config(string $name)
    {
        return (new \core\Config())->config($name);
    }
}

if (!function_exists('route')) {


    /**
     * 获取当前控制器和方法名
     * @param string $name
     * @return array|string|bool
     */
    function route(string $name)
    {
        $route = new \core\Route();
        switch ($name) {
            case 'action':
                return $route->action;
            case 'controller':
                return $route->controller;
            case 'all':
                return [$route->action, $route->controller];
            default:
                return false;
        }
    }
}