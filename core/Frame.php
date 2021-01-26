<?php
declare(strict_types=1);

namespace core;

class Frame
{
    /**
     * 存放已经加载的类
     * @var array
     */
    static $classMap = array();

    /**
     * 框架入口
     */
    public function run()
    {
        ps(__CLASS__ . " 框架入口");
        /** 加载配置 */
        $config = new Config();
        $config->run();
    }

    /**
     * 自动加载
     * @param string $className
     * @return bool
     */
    public static function loader(string $className): bool
    {
        ps("自动加载:{$className} ");

        /** 判断是否已经存在类 */
        if (isset(self::$classMap[$className])) {
            return true;
        }

        /** 处理自动加载 */
        $classPath = str_replace('\\', '/', $className);

        /** 组合路径 */
        $classPath = appPath . $classPath . '.php';

        /** 判断文件是否存在 */
        if (!is_file($classPath)) {
            ps("自动加载出错:{$className}不存在此文件");
            return false;
        }

        /** 加载文件信息 */
        include $classPath;
        self::$classMap[$className] = $classPath;
        return true;
    }

}