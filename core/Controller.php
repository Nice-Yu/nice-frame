<?php
declare(strict_types=1);

namespace core;
class Controller
{
    /** 存放变量信息 */
    public $view;

    /**
     * 视图变量转换
     * @param string $name
     * @param $value
     */
    public function assign(string $name, $value)
    {
        $this->view[$name] = $value;
    }

    /**
     * 模板地址
     * @param string $templatePath
     */
    public function display(string $templatePath = '')
    {
        ps('抵达视图');
        $templateDir = '';
        $templateFile = '';

        /** 如果存在跨目录 */
        if (is_numeric(strpos($templatePath, '/')) && !empty($templatePath)) {
            list($templateDir, $templateFile) = explode('/', $templatePath);
        }

        /** 不目录,但是跨文件夹 */
        if (!is_numeric(strpos($templatePath, '/')) && !empty($templatePath)) {
            $templateDir = route('controller');
            $templateFile = $templatePath;
        }

        /** 如果等于空 */
        if ($templatePath === '') {
            list($templateDir, $templateFile) = route('all');
        }

        /** 默认不做任何处理 */
//        ucfirst(); ucwords();

        /** 组合路径 */
        $viewPath = config('app.view_path') . $templateDir . '/' . $templateFile . '.html';
        if (!is_file($viewPath)) {
            ps("不存在的视图文件: {$viewPath}");
        }

        /** 引入视图文件 */
        if (!empty($this->view)) {
            extract($this->view);
        }
        include $viewPath;
    }
}