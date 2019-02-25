<?php
namespace app\admin\controller;

use think\Controller;

class Common extends Controller
{
    public function _initialize()
    {
        if (session('admin_user_status') !== true) {
            $this->error('请先登录！', 'admin/Login/login','',1);
        }
    }
}
?>