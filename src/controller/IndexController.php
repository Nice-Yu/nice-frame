<?php
declare(strict_types=1);

namespace src;
class IndexController
{

    public function index()
    {
        ps('欢迎来到控制器: ' . __CLASS__ . ' => index');
    }
}