<?php 
namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Users as us;

class Users extends Common
{
	public function userList(Request $request)
	{
		$id=$request->param('id')>0?$request->param('id'):1;
        $pre = $id>1?$id-1:1;
		$start=($id-1)*10; 
		$count = us::count();
        $max=ceil($count/10);
        $next=$id<$max?$id+1:$max;
		// 查询数据
        $res = us::limit($start,10)->select();
        
        
        // 将数据分配到模板
        $this->assign('pre',$pre);
        $this->assign('next',$next);
        $this->assign('max',$max);
        $this->assign('id',$id);
        $this->assign('count', $count);
        $this->assign('res', $res);
		return $this->fetch('userList');
	}

    public function insert()
    {
        header("Content-Type:text/html; charset=utf-8");
        error_reporting(E_ALL | E_STRICT);
        //接收数据
        $checkno=$_POST["checkno"];
        $uname=$_POST["uname"];
        $upwd=$_POST["upwd"];
        $upassword=$_POST["upassword"];
        $uemail=$_POST["uemail"];
        $captcha = new \think\captcha\Captcha();
        $result=$captcha->check($checkno);
        include("../application/index/controller/functions.php");
        if($result===true){
            //验证数据
            if($uname==""){js_back("用户名不能为空!");}
            if(strlen($uname)<3||strlen($uname)>20){
                js_back("用户名长度必须为3~20!");
            }
            if($upwd==""){js_back("密码不能为空!");}
            if($upwd!=$upassword){js_back("两次密码不一致!");}
            if($uemail==""){js_back("email不能为空！");}
            $pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
            if( !preg_match($pattern,$uemail)){
                js_back("email格式不对！");
            }


            include("../application/index/controller/connect.php");
            //编写sql语句
            $sql="insert into users(uname,upwd,upassword,uemail,udate) values('$uname',md5('$upwd'),md5('$upassword'),'$uemail',now())";
            //执行
            $result1=mysql_query($sql);
            if($result1>0){
                js_go("注册成功！",url('index/Index/login'));
            }
            else{
                js_back("注册失败！");
            }
        }
        else{
            js_back("验证码错误！");
        }
    }

    public function insert1()
    {
        header("Content-Type:text/html; charset=utf-8");
        error_reporting(E_ALL | E_STRICT);
        $usex=isset($_POST['usex'])?$_POST['usex']:'男';
        $uage=isset($_POST['uage'])?$_POST['uage']:null;
        $uphone=isset($_POST['uphone'])?$_POST['uphone']:null;
        $ubltid=isset($_POST['ubltid'])?$_POST['ubltid']:null;
        $id=$_COOKIE['ckuid'];
        include("../application/index/controller/functions.php");
        include("../application/index/controller/connect.php");
        $sql="update users set usex='$usex',uage=$uage,uphone=$uphone,ubltid=$ubltid where uid=$id";
        $result1=mysql_query($sql);
        if($result1>0){
            js_go("完善成功！",url('index/Forum/member_center'));
        }
        else{
            js_back("完善失败！");
        }
    }

    public function update()
    {
        header("Content-Type:text/html; charset=utf-8");
        error_reporting(E_ALL | E_STRICT);
        $uname=$_POST["uname"];
        $uemail=$_POST["uemail"];
        $usex=isset($_POST['usex'])?$_POST['usex']:'男';
        $uage=$_POST["uage"];
        $uphone=$_POST["uphone"];
        $ubltid=$_POST["ubltid"];
        $id=$_COOKIE['ckuid'];
        include("../application/index/controller/functions.php");
        if($uname==""){js_back("用户名不能为空!");}
        if(strlen($uname)<3||strlen($uname)>20){
            js_back("用户名长度必须为3~20!");
        }
        if($uemail==""){js_back("email不能为空！");}
        $pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
        if( !preg_match($pattern,$uemail)){
            js_back("email格式不对！");
        }
        if($uage==""){js_back("年龄不能为空!");}
        if($uphone==""){js_back("号码不能为空!");}
        if($ubltid==""){js_back("所属不能为空!");}
        include("../application/index/controller/connect.php");
        $sql="update users set uname='$uname',uemail='$uemail',usex='$usex',uage='$uage',uphone='$uphone',ubltid='$ubltid' where uid=$id";
        $result1=mysql_query($sql);
        if($result1>0){
            js_go("修改成功！",url('index/Forum/member_center'));
        }
        else{
            js_back("修改失败！");
        }
    }

	public function checkUser(Request $request)
	{
		$p = $request->param('p');
		$id = $request->param('id');
		$res = us::find($id);
		$this->assign('p', $p);
		$this->assign('res', $res);
		return $this->fetch('checkUser');
	}

	public function delete(Request $request)
    {
    	$id = $request->param('id');
    	$res = us::destroy($id);
    	if ($res) {
    		$this->success('删除成功',url('admin/Users/userList',['id'=> 1]));
    	} else {
    		$this->error('删除失败');
    	}
    }
}
?>