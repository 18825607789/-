<?php
namespace app\index\controller;

use think\Controller;

class Index extends Common
{
    public function index()
    {
        return $this->fetch('index');
    }

    public function login()
    {
        return $this->fetch('Login & Register/login');
    }

    public function logindo()
    {
        header("Content-Type:text/html; charset=utf-8");
        include("../application/index/controller/functions.php");
        $uname=$_POST["uname"];
        $upwd=$_POST["upwd"];
        //验证数据
        if($uname==""){
            js_back("用户名不能为空！");
        }
        if($upwd==""){
            js_back("密码不能为空！");
        }
        //与数据库交互
        include("../application/index/controller/connect.php");
        //编写sql语句
        $sql="select uid from users where uname='$uname'and upwd=md5('$upwd')";
        //执行sql语句
        $result=mysql_query($sql);
        $row=mysql_fetch_array($result);
        if($row>0){//http://192.168.1.200:8080
            cookie("ckuname",$uname);
            cookie("ckuid",$row['uid']);
            js_go("登录成功！",url('index/Company/company_forum'));
        }
        else{
            js_back("登录失败：用户名或密码不对！");
        }
    }

    public function logout()
    {
        include("../application/index/controller/functions.php");
        cookie('ckuname',null);
        cookie('ckuid',null);
        js_go("退出成功！",url('index/Company/company_forum'));
    }

    public function register()
    {
        return $this->fetch('Login & Register/register');
    }

    public function contact_us()
    {
        return $this->fetch('contact_us');
    }
}
