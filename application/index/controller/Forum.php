<?php
namespace app\index\controller;

use think\Controller;

class Forum extends Common
{
    public function forum_details()
    {
        return $this->fetch('forum_details');
    }

    public function forum_help()
    {
        return $this->fetch('forum_help');
    }

    public function forum_list()
    {
        return $this->fetch('forum_list');
    }

    public function forum_search()
    {
        return $this->fetch('forum_search');
    }

    public function member_center()
    {
        include("../application/index/controller/functions.php");
        if(isset($_COOKIE['ckuid'])){
            return $this->fetch('member_center');
        }else{
            js_go("请先登录！",url('index/Index/login'));
        }
    }
}
