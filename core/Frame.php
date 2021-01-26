<?php
declare(strict_types=1);

namespace core;

class Frame
{

    /**
     * 框架入口
     */
    public function run()
    {
        echo __CLASS__ . "框架入口 <hr/>";
    }

    /**
     * 自动载入
     * @param string $nameSpace
     */
    public static function loader(string $nameSpace)
    {

        echo __CLASS__ . "{$nameSpace} <hr/>";
    }
}