<?php
namespace app\admin\controller;

use think\Collection;
use think\Request;

class Index extends Common
{
    public function index()
    {
        return $this->fetch();
    }

    public function forumIndex()
    {
        return $this->fetch("forumIndex");
    }

    public function logout()
    {
        session('admin_user_status', null);
        session('aname', null);
        session('aid', null);
        $this->success('退出成功', 'admin/Login/login');
    }
}
?>