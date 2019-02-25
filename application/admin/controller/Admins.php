<?php 
namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Admins as ad;
use app\admin\model\Level;

class Admins extends Common
{
	public function adminList(Request $request)
	{
		$id=$request->param('id')>0?$request->param('id'):1;
        $pre = $id>1?$id-1:1;
		$start=($id-1)*10; 
		$count = ad::count();
        $max=ceil($count/10);
        $next=$id<$max?$id+1:$max;
		// 查询数据
        $res = ad::limit($start,10)->select();
        $res2 = level::select();
        $res3 = [];
        foreach ($res2 as $key => $value) {
        	$res3[$value->lid] = $value->lname;
        }
        
        
        // 将数据分配到模板
        $this->assign('pre',$pre);
        $this->assign('next',$next);
        $this->assign('max',$max);
        $this->assign('id',$id);
        $this->assign('count', $count);
        $this->assign('res', $res);
        $this->assign('res3', $res3);
		return $this->fetch('adminList');
	}

	public function addAdmin()
	{
    	return $this->fetch('addAdmin');
	}

	public function edit(Request $request)
	{
		$p = $request->param('p');
		$id = $request->param('id');
		$res = ad::find($id);
		$res2 = level::select();
		$this->assign('p', $p);
		$this->assign('res', $res);
		$this->assign('res2', $res2);
		return $this->fetch('edit');
	}

	public function insert(Request $request)
    {
        $admin_user = $request->post();
        unset($admin_user['_method']);
        if ($admin_user['apwd'] == $admin_user["apassword"]) {
            $admin_user['apwd'] = md5($admin_user['apwd']);
            $admin_user['apassword'] = md5($admin_user['apassword']);
            if (ad::create($admin_user)) {
                $this->success('添加成功', url('admin/Admins/adminList',['id'=> 1]));
            } else {
                $this->error('添加失败');
            }
        } else {
            $this->error("两次密码不一致");
        }
    }

    public function delete(Request $request)
    {
    	$id = $request->param('id');
    	$res = ad::destroy($id);
    	if ($res) {
    		$this->success('删除成功',url('admin/Admins/adminList',['id'=> 1]));
    	} else {
    		$this->error('删除失败');
    	}
    }

    public function update(Request $request)
    {
        $id = ad::find($request->param('id'));
        if($request->param('apwd')==$request->param('apassword')){
	        $res = $id->save([
	        	'apwd' => md5($request->param('apwd')),
	        	'apassword' => md5($request->param('apassword')),
	        	'anumber' => $request->param('anumber'),
	        	'aname' => $request->param('aname'),
	        	'alid' => $request->param('alid')
	        ]);
	        if ($res) {
	            $this->success('修改成功',url('admin/Admins/adminList',['id'=> $request->param('p')]),'',2);
	        } else {
	            $this->error('修改失败');
	        }
	    }else {
	    	$this->error("两次密码不一致!");
	    }  
    }
}
?>