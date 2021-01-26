<?php
declare(strict_types=1);

namespace core;

use app\IndexController;

class Route
{
    /** 控制器 */
    public $controller = 'index';

    /** 方法名 */
    public $action = 'index';

    /** 存储信息 */
    public $ctrlArr = array();

    /**
     * 加载路由
     */
    public function run()
    {
        ps('路由初始化');
//        $path = '/';
//        $path = '/index.php';
//        $path = '/index.php/controller';
//        $path = '/index.php/controller/action';
        $path = '/index.php/Index/Index/id/5/xxx/121/xxxx/21';
//        $this->setRoute($_SERVER['REQUEST_URI']);
        $this->setRoute($path);
        $this->setCtrl();
        $this->makeCtrl();
    }

    /**
     * 置顶路由到某个控制器方法
     */
    public function makeCtrl()
    {
        /** 组装控制器地址 */
        $ctrlName = $this->controller . 'Controller.php';
        $ctrlPath = appPath . appName . '/controller/' . $ctrlName;
        if (is_file($ctrlPath)) {
            /** 指向到控制方法 */
            include $ctrlPath;
            $nameSpace = '\src\\' . $this->controller . 'Controller';
            $ctrl = new $nameSpace();
            $action = $this->action;
            $ctrl->$action();
        } else {
            ps('找不到控制器：' . $this->controller . 'Controller.php');
        }
    }

    /**
     * 设置控制器和方法
     */
    public function setCtrl()
    {
        $pathArr = $this->ctrlArr;
        /** 完整uri */
        if (count($pathArr) >= 2) {
            /** 控制器 */
            if (isset($pathArr[0])) {
                $this->controller = $pathArr[0];
                unset($pathArr[0]);
            }

            /** 方法 */
            if (isset($pathArr[1])) {
                $this->action = $pathArr[1];
                unset($pathArr[1]);
            }

            /** 处理一下 $_GET */
            if (count($pathArr) > 0) {
                $this->setParam($pathArr);
            }
        }
    }

    /**
     * 处理 get 请求参数
     * @param $param
     */
    public function setParam($param)
    {
        $i = 2;
        while ($i <= count($param)) {
            if (isset($param[$i]) && isset($param[$i + 1])) {
                $_GET[$param[$i]] = $param[$i + 1];
            }
            $i += 2;
        }
    }


    /**
     * 拆分路由
     * @param string $path
     */
    public function setRoute(string $path)
    {
        /** 如果存在 /index.php 则去除 */
        if (strpos($path, '/index.php') === 0) {
            $path = str_replace('/index.php', '', $path);
        }
        /** 去除掉 开头结尾 `/` */
        if (strpos($path, '/') === 0) {
            $path = trim($path, '/');
        }
        $pathArr = array();
        if (strlen($path) !== 0) {
            $pathArr = explode('/', $path);
        }
        $this->ctrlArr = $pathArr;
    }

}