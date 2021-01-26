<?php
declare(strict_types=1);

namespace core;

class Config
{
    /**
     * 配置信息
     * @var array
     */
    static $config = array();


    /**
     * 加载配置
     */
    public function run()
    {
        ps(__CLASS__ . " 加载配置 ");
        $dirPath = appPath . 'config';
        $config = scandir($dirPath);
        foreach ($config as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }
            $classContent = include $dirPath . '/' . $item;
            $configName = str_replace('.php', '', $item);
            self::$config[$configName] = $classContent;
        }
        ps(self::$config['app']['app_path']);
    }

}