<?php
declare(strict_types=1);

namespace src;

use core\Controller;
use src\model\UserModel;

class IndexController extends Controller
{

    public function index()
    {
        ps('欢迎来到控制器: ' . __CLASS__ . ' => index');
        $data = (new UserModel())->getAll();
        ps($data);
        $this->assign('title', '这可能是一个标题');
        $this->assign('content', '这肯定一个内容了');
        $this->display('indexs/action');
    }
}