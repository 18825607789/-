<?php
namespace app\admin\controller;

use think\Controller;

class Checkno extends Controller
{
    public function show_captcha(){
        $captcha = new \think\captcha\Captcha();
        $captcha->imageW = 120;
        $captcha->imageH = 30;  //图片高
        $captcha->fontSize =15;  //字体大小
        $captcha->length   = 4;  //字符数
        $captcha->fontttf = '6.ttf';  //字体
        $captcha->expire = 30;  //有效期
        $captcha->useNoise = false;  //不添加杂点
        $captcha->reset = true;
        return $captcha->entry();
	}
}
?>