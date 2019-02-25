<?php 
namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Reply as re;
use app\admin\model\Users as us;
use app\admin\model\Post as po;

class Reply extends Common
{
	public function replyList(Request $request)
	{
		$id=$request->param('id')>0?$request->param('id'):1;
		$pre = $id>1?$id-1:1;
		$start=($id-1)*10;
		$count = re::count();
		$res = re::limit($start,10)->select();
        $max=ceil($count/10);
        $next=$id<$max?$id+1:$max;
		// 查询数据
        
        $res2 = us::field('uid,uname')->select();
        $res3 = [];
        foreach ($res2 as $key => $value) {
        	$res3[$value->uid] = $value->uname;
        }
        $res4 = po::field('pid,ptitle')->select();
        $res5 = [];
        foreach ($res4 as $key => $value) {
        	$res5[$value->pid] = $value->ptitle;
        }
        
        
        // 将数据分配到模板
        $this->assign('pre',$pre);
        $this->assign('next',$next);
        $this->assign('max',$max);
        $this->assign('id',$id);
        $this->assign('count', $count);
        $this->assign('res', $res);
        $this->assign('res3', $res3);
        $this->assign('res5', $res5);
		return $this->fetch('replyList');
	}

	public function checkReply(Request $request)
	{
		$p = $request->param('p');
		$id = $request->param('id');
		$res = re::find($id);
		$uid = $res['ruid'];
		$res2 = us::field('uid,uname')->where('uid',$uid)->select();
		foreach ($res2 as $key => $value) {
        	$res3[$value->uid] = $value->uname;
        }
		$uname = $res3[$uid];
		$this->assign('p', $p);
		$this->assign('res', $res);
		$this->assign('uname', $uname);
		return $this->fetch('checkReply');
	}

	public function search(Request $request)
	{
		$id=$request->param('id')>0?$request->param('id'):1;
		$rpid = $request->post('rpid');
		$pre = $id>1?$id-1:1;
		$start=($id-1)*10;
		$ptitle = po::field('pid,ptitle')->where('ptitle','like','%'.$rpid.'%')->select();
		foreach ($ptitle as $key => $value) {
    		$rptitle[$value->ptitle] = $value->pid;
    	}
    	$count = re::where('rpid',$rptitle[$value->ptitle])->count();
		$res = re::where('rpid',$rptitle[$value->ptitle])->limit($start,10)->select();
        $max=ceil($count/10);
        $next=$id<$max?$id+1:$max;
		// 查询数据
        
        $res2 = us::field('uid,uname')->select();
        $res3 = [];
        foreach ($res2 as $key => $value) {
        	$res3[$value->uid] = $value->uname;
        }
        $res4 = po::field('pid,ptitle')->select();
        $res5 = [];
        foreach ($res4 as $key => $value) {
        	$res5[$value->pid] = $value->ptitle;
        }
        
        
        // 将数据分配到模板
        $this->assign('pre',$pre);
        $this->assign('next',$next);
        $this->assign('max',$max);
        $this->assign('id',$id);
        $this->assign('count', $count);
        $this->assign('res', $res);
        $this->assign('res3', $res3);
        $this->assign('res5', $res5);
		return $this->fetch('replyList');
	}

    public function insert()
    {
        header("Content-Type:text/html; charset=utf-8");
        error_reporting(E_ALL | E_STRICT);
        //接收数据
        $checkno=$_POST["checkno"];
        $rcontent=$_POST["rcontent"];
        $rpid=$_POST["rpid"];
        $captcha = new \think\captcha\Captcha();
        $result=$captcha->check($checkno);
        include("../application/index/controller/functions.php");
        if(isset($_COOKIE['ckuid'])){   
            $ruid=$_COOKIE['ckuid'];
            if($result===true){
                //验证数据
                if($rcontent==""){js_back("内容不能为空!");}
                include("../application/index/controller/connect.php");
                $sql="insert into reply(rpid,ruid,rcontent,rdate) values($rpid,$ruid,'$rcontent',now())";
                $result1=mysql_query($sql);
                if($result1>0){
                    js_go("回复成功！",url('index/Company/company_forum'));
                }
                else{
                    js_back("回复失败！");
                }
            }
            else{
                js_back("验证码错误！");
            }
        }else{
            js_go("请先登录！",url('index/Index/login'));
        }
    }

    public function delete(Request $request)
    {
        $id = $request->param('id');
        $res = re::destroy($id);
        if ($res) {
            $this->success('删除成功',url('admin/Reply/replyList',['id'=> 1]));
        } else {
            $this->error('删除失败');
        }
    }

}
?>