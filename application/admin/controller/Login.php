<?php 
namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Admins as ad;
use think\Validate;

class Login extends Controller
{
    public function login()
    {
        return $this->fetch('login');
    }

    public function logindo(Request $request)
    {
        $post = $request->post();
        $captcha = new \think\captcha\Captcha();
        $result = $captcha->check($post['captcha']);
        unset($post['captcha']);
        $post['apwd'] = md5($post['apwd']);
        if($result===true){
            $res = ad::where($post)->find();
            if ($res) {
                session('admin_user_status', true);
                session('aname', $res->aname);
                session('aid', $res->aid);
                $this->success('登录成功', url('admin/Index/index'));
            } else {
            $this->error('登录失败, 账号或密码错误！');
            }
        } else {
            $this->error('登录失败, 验证码错误！');
        }     
    }
}
?>