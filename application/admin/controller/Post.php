<?php 
namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Post as po;
use app\admin\model\Users as us;
use app\admin\model\Blocktheme as blt;
use app\admin\model\Block as bl;

class Post extends Common
{
	public function postList(Request $request)
	{
		$id=$request->param('id')>0?$request->param('id'):1;
		$pre = $id>1?$id-1:1;
		$start=($id-1)*10;
		$count = po::count();
		$res = po::limit($start,10)->select();
        $max=ceil($count/10);
        $next=$id<$max?$id+1:$max;
		// 查询数据
        
        $res2 = us::field('uid,uname')->select();
        $res3 = [];
        foreach ($res2 as $key => $value) {
        	$res3[$value->uid] = $value->uname;
        }
        $res4 = blt::field('bltid,bltname')->select();
        $res5 = [];
        foreach ($res4 as $key => $value) {
        	$res5[$value->bltid] = $value->bltname;
        }
        // $res6 = blt::field('bltid,blbltid')->select();
        // $res7 = [];
        // foreach ($res6 as $key => $value) {
        // 	$res7[$value->bltid] = $value->blbltid;
        // }
        $res6 = bl::field('blid,blname')->select();
        $res7 = [];
        foreach ($res6 as $key => $value) {
        	$res7[$value->blid] = $value->blname;
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
        $this->assign('res7', $res7);
		return $this->fetch('postList');
	}

	public function checkPost(Request $request)
	{
		$p = $request->param('p');
		$id = $request->param('id');
		$res = po::find($id);
		$uid = $res['puid'];
		$blid = $res['pblid'];
		$bltid = $res['pbltid'];
		$res2 = us::field('uid,uname')->where('uid',$uid)->select();
		foreach ($res2 as $key => $value) {
        	$res3[$value->uid] = $value->uname;
        }
		$uname = $res3[$uid];
		$res4 = bl::field('blid,blname')->where('blid',$blid)->select();
		foreach ($res4 as $key => $value) {
        	$res5[$value->blid] = $value->blname;
        }
		$blname = $res5[$blid];
		$res6= blt::field('bltid,bltname')->where('bltid',$bltid)->select();
		foreach ($res6 as $key => $value) {
        	$res7[$value->bltid] = $value->bltname;
        }
		$bltname = $res7[$bltid];
		$this->assign('p', $p);
		$this->assign('res', $res);
		$this->assign('uname', $uname);
		$this->assign('blname', $blname);
		$this->assign('bltname', $bltname);
		return $this->fetch('checkPost');
	}

	public function searchbl(Request $request)
	{
		$id=$request->param('id')>0?$request->param('id'):1;
		$pre = $id>1?$id-1:1;
		$start=($id-1)*10;
		$pblid = $request->post('pblid');
		$blname = bl::field('blid,blname')->where('blname','like','%'.$pblid.'%')->select();
		foreach ($blname as $key => $value) {
        	$pblname[$value->blname] = $value->blid;
        }
		$count = po::where('pblid',$pblname[$value->blname])->count();
		$res = po::where('pblid',$pblname[$value->blname])->limit($start,10)->select();
		$max=ceil($count/10);
        $next=$id<$max?$id+1:$max;

        $res2 = us::field('uid,uname')->select();
        $res3 = [];
        foreach ($res2 as $key => $value) {
        	$res3[$value->uid] = $value->uname;
        }
        $res4 = blt::field('bltid,bltname')->select();
        $res5 = [];
        foreach ($res4 as $key => $value) {
        	$res5[$value->bltid] = $value->bltname;
        }
        $res6 = bl::field('blid,blname')->select();
        $res7 = [];
        foreach ($res6 as $key => $value) {
        	$res7[$value->blid] = $value->blname;
        }

        $this->assign('pre',$pre);
        $this->assign('next',$next);
        $this->assign('max',$max);
        $this->assign('id',$id);
        $this->assign('count', $count);
        $this->assign('res', $res);
        $this->assign('res3', $res3);
        $this->assign('res5', $res5);
        $this->assign('res7', $res7);
		return $this->fetch('postList');
	}

	public function searchblt(Request $request)
	{
		$id=$request->param('id')>0?$request->param('id'):1;
		$pre = $id>1?$id-1:1;
		$start=($id-1)*10;
		$pbltid = $request->post('pbltid');
		$bltname = blt::field('bltid,bltname')->where('bltname','like','%'.$pbltid.'%')->select();
		foreach ($bltname as $key => $value) {
        	$pbltname[$value->bltname] = $value->bltid;
        }
		$count = po::where('pbltid',$pbltname[$value->bltname])->count();
		$res = po::where('pbltid',$pbltname[$value->bltname])->limit($start,10)->select();
		$max=ceil($count/10);
        $next=$id<$max?$id+1:$max;

        $res2 = us::field('uid,uname')->select();
        $res3 = [];
        foreach ($res2 as $key => $value) {
        	$res3[$value->uid] = $value->uname;
        }
        $res4 = blt::field('bltid,bltname')->select();
        $res5 = [];
        foreach ($res4 as $key => $value) {
        	$res5[$value->bltid] = $value->bltname;
        }
        $res6 = bl::field('blid,blname')->select();
        $res7 = [];
        foreach ($res6 as $key => $value) {
        	$res7[$value->blid] = $value->blname;
        }

        // dump($count);

        $this->assign('pre',$pre);
        $this->assign('next',$next);
        $this->assign('max',$max);
        $this->assign('id',$id);
        $this->assign('count', $count);
        $this->assign('res', $res);
        $this->assign('res3', $res3);
        $this->assign('res5', $res5);
        $this->assign('res7', $res7);
		return $this->fetch('postList');
	}

    public function insert()
    {
        header("Content-Type:text/html; charset=utf-8");
        error_reporting(E_ALL | E_STRICT);
        $pblid=$_POST["pblid"];
        $pbltid=$_POST["pbltid"];
        $ptitle=$_POST["ptitle"];
        $pcontent=$_POST["pcontent"];
        include("../application/index/controller/functions.php");
        if(isset($_COOKIE['ckuid'])){
            $puid=$_COOKIE['ckuid'];
            if($ptitle==""){js_back("标题不能为空!");}
            if($pcontent==""){js_back("内容不能为空！");}
            include("../application/index/controller/connect.php");
            $sql="insert into post(pblid,pbltid,puid,ptitle,pcontent,pdate) values($pblid,$pbltid,$puid,'$ptitle','$pcontent',now())";
            $result=mysql_query($sql);
            if($result>0){
                js_go("发帖成功！",url('index/Company/company_forum'));
            }
            else{
                js_back("发帖失败！");
            }
        }else{
            js_go("请先登录！",url('index/Index/login'));
        }
    }

	public function delete(Request $request)
    {
    	$id = $request->param('id');
    	$res = po::destroy($id);
    	if ($res) {
    		$this->success('删除成功',url('admin/Post/postList',['id'=> 1]));
    	} else {
    		$this->error('删除失败');
    	}
    }
}
?>