<?php
declare(strict_types=1);

namespace core;
class Module extends \PDO
{
    /**
     * 默认连接
     */
    public function __construct()
    {
        list($dsn, $username, $passwd) = $this->makeMysql();
//        try {
        return parent::__construct($dsn, $username, $passwd);
//        } catch (\PDOException $e) {
//            ps($e->getMessage());
//        }
    }

    /**
     * 执行默认信息
     */
    public function makeMysql()
    {
        $data = config('database');
        $dsn = "{$data['type']}:host={$data['hostname']};dbname={$data['database']}";
        return [$dsn, $data['username'], $data['password']];
    }

}