<?php 
namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Info as in;
use app\admin\model\Infoclass as inc;

class Info extends Common
{
	public function infoList(Request $request)
	{
		$id=$request->param('id')>0?$request->param('id'):1;
        $pre = $id>1?$id-1:1;
		$start=($id-1)*10; 
		$count = in::count();
        $max=ceil($count/10);
        $next=$id<$max?$id+1:$max;
		// 查询数据
        $res = in::limit($start,10)->select();
        $res2 = inc::select();
        $res3 = [];
        foreach ($res2 as $key => $value) {
        	$res3[$value->icid] = $value->icname;
        }
        
        
        // 将数据分配到模板
        $this->assign('pre',$pre);
        $this->assign('next',$next);
        $this->assign('max',$max);
        $this->assign('id',$id);
        $this->assign('count', $count);
        $this->assign('res', $res);
        $this->assign('res3', $res3);
		return $this->fetch('infoList');
	}

	public function addInfo()
	{
		$res = inc::select();
        $this->assign('res', $res);
		return $this->fetch('addInfo');
	}

	public function edit(Request $request)
	{
		$p = $request->param('p');
		$id = $request->param('id');
		$res = in::find($id);
		$res2 = inc::select();
		$this->assign('p', $p);
		$this->assign('res', $res);
		$this->assign('res2', $res2);
		return $this->fetch('edit');
	}

	public function insert(Request $request)
    {
        $info = $request->post();
        unset($info['_method']);
        if ($info['icontent'] != ""&&$info['icontent'] != null) {
            if (in::create($info)) {
                $this->success('添加成功', url('admin/Info/infoList',['id'=> 1]));
            } else {
                $this->error('添加失败');
            }
        } else {
            $this->error("添加失败，内容不能为空！");
        }
    }

    public function delete(Request $request)
    {
    	$id = $request->param('id');
    	$res = in::destroy($id);
    	if ($res) {
    		$this->success('删除成功',url('admin/Info/infoList',['id'=> 1]));
    	} else {
    		$this->error('删除失败');
    	}
    }

    public function update(Request $request)
    {
        $id = in::find($request->param('id'));
        if($request->param('icontent')!="" && $request->param('icontent')!= null){
	        $res = $id->save([
	        	'icontent' => $request->param('icontent'),
                'iicid' => $request->param('iicid')
	        ]);
	        if ($res) {
	            $this->success('修改成功',url('admin/Info/infoList',['id'=> $request->param('p')]),'',2);
	        } else {
	            $this->error('修改失败！');
	        }
	    }else {
	    	$this->error("修改失败，内容不能为空！");
	    }  
    }
}
?>