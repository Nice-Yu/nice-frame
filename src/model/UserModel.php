<?php
declare(strict_types=1);

namespace src\model;

use core\Module;

class UserModel extends Module
{

    /**
     * 获取所有信息
     * @return array
     */
    public function getAll()
    {
        $sql = "select * from user where `id`=1";
        $res = $this->query($sql);
        return $res->fetchAll();
    }
}