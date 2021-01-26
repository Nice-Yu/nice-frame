<?php
declare(strict_types=1);

namespace core;

class Frame
{

    /** 存放已经引入的类 */
    static $classMap = array();


    /**
     * 框架入口
     */
    public function run()
    {
        ps(__CLASS__ . "框架入口");
        $config = new Config();
        $config->run();
        ps($config->config('database'));
        ps($config->config('app.app_path'));
    }

    /**
     * 自动载入
     * @param string $nameSpace
     * @return bool
     */
    public static function loader(string $nameSpace): bool
    {
        ps("自动载入: {$nameSpace}");

        /** 判断类是否已经引入 */
        if (isset(self::$classMap[$nameSpace])) {
            return true;
        }

        /** 组合路径 */
        $class = str_replace('\\', '/', $nameSpace);
        $classPath = appPath . $class . '.php';

        /** 去除掉不存在的类文件 */
        if (!is_file($classPath)) {
            return false;
        }

        /** 引入类文件 */
        include $classPath;
        self::$classMap[$nameSpace] = $classPath;
        return true;
    }
}