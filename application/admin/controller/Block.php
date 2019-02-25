<?php 
namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Block as bl;
use app\admin\model\Users as us;

class Block extends Common
{
	public function blockList(Request $request)
	{
		$id=$request->param('id')>0?$request->param('id'):1;
        
        $pre = $id>1?$id-1:1;
		$start=($id-1)*10; 
		$count = bl::count();
        $max=ceil($count/10);
        $next=$id<$max?$id+1:$max;
		// 查询数据
        $res = bl::limit($start,10)->select();
        $res2 = us::field('uid,uname')->select();
        $res3 = [];
        foreach ($res2 as $key => $value) {
        	$res3[$value->uid] = $value->uname;
        }
        
        
        // 将数据分配到模板
        $this->assign('pre',$pre);
        $this->assign('next',$next);
        $this->assign('max',$max);
        $this->assign('id',$id);
        $this->assign('count', $count);
        $this->assign('res', $res);
        $this->assign('res3', $res3);
		return $this->fetch('blockList');
	}

	public function addBlock()
	{
		$res = us::field('uid,uname')->select();
        $this->assign('res', $res);
		return $this->fetch('addBlock');
	}

	public function edit(Request $request)
	{
		$p = $request->param('p');
		$id = $request->param('id');
		$res = bl::find($id);
		$res2 = us::select();
		$this->assign('p', $p);
		$this->assign('res', $res);
		$this->assign('res2', $res2);
		return $this->fetch('edit');
	}

	public function insert(Request $request)
    {
        $block = $request->post();
        unset($block['_method']);
        if ($block['blname'] != ""&& $block["blname"]!=null) {
            if (bl::create($block)) {
                $this->success('添加成功', url('admin/Block/blockList',['id'=> 1]));
            } else {
                $this->error('添加失败');
            }
        } else {
            $this->error("添加失败，分区名称不能为空！");
        }
    }

    public function delete(Request $request)
    {
    	$id = $request->param('id');
    	$res = bl::destroy($id);
    	if ($res) {
    		$this->success('删除成功',url('admin/Block/blockList',['id'=> 1]));
    	} else {
    		$this->error('删除失败');
    	}
    }

    public function update(Request $request)
    {
        $id = bl::find($request->param('id'));
        if($request->param('blname')!="" && $request->param('blname')!= null){
	        $res = $id->save([
	        	'blname' => $request->param('blname'),
	        	'bluid' => $request->param('bluid')
	        ]);
	        if ($res) {
	            $this->success('修改成功',url('admin/Block/blockList',['id'=> $request->param('p')]),'',2);
	        } else {
	            $this->error('修改失败！');
	        }
	    }else {
	    	$this->error("修改失败，分区名称不能为空！");
	    }  
    }
}
?>