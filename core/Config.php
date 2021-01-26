<?php
declare(strict_types=1);

namespace core;

class Config
{

    public static $configData;

    /**
     * 配置入口
     */
    public function run()
    {
        ps(__CLASS__ . "配置入口");

        /** 组合路径 */
        $dirPath = appPath . 'config';
        $config = scandir($dirPath);

        foreach ($config as $item) {
            /** 跳出本次循环 */
            if ($item == '.' || $item == '..') {
                continue;
            }
            $classPath = $dirPath . '/' . $item;
            if (is_file($classPath)) {
                $class = include $classPath;
                $configName = str_replace('.php', '', $item);
                self::$configData[$configName] = $class;
            }
        }
    }

    /**
     * 获取到配置信息
     * @param string $name
     * @return false|mixed
     */
    public function config(string $name)
    {
        $dirName = $name;
        $configName = '';
        /** 分割配置信息 */
        if (strpos($name, '.')) {
            list($dirName, $configName) = explode('.', $name);
        }

        /** 获取配置 */
        $config = self::$configData;

        /** 拿到一级配置信息 */
        if ($configName === '' && isset($config[$dirName])) {
            return $config[$dirName];
        }

        /** 拿到耳机配置信息 */
        if ($configName !== '' && isset($config[$dirName][$configName])) {
            return $config[$dirName][$configName];
        }
        return false;
    }

}