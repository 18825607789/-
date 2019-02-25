<?php 
namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Infoclass as inc;

class Infoclass extends Common
{
	public function infoClassilyList(Request $request)
	{
		$id=$request->param('id')>0?$request->param('id'):1;
        $pre = $id>1?$id-1:1;
		$start=($id-1)*10; 
		$count = inc::count();
        $max=ceil($count/10);
        $next=$id<$max?$id+1:$max;
		// 查询数据
        $res = inc::limit($start,10)->select();
        
        
        // 将数据分配到模板
        $this->assign('pre',$pre);
        $this->assign('next',$next);
        $this->assign('max',$max);
        $this->assign('id',$id);
        $this->assign('count', $count);
        $this->assign('res', $res);
		return $this->fetch('infoClassilyList');
	}
	
	public function addInfoClassily()
	{
		return $this->fetch('addInfoClassily');
	}

	public function edit(Request $request)
	{
		$p = $request->param('p');
		$id = $request->param('id');
		$res = inc::find($id);
		$this->assign('p', $p);
		$this->assign('res', $res);
		return $this->fetch('edit');
	}

	public function insert(Request $request)
    {
        $infoclass = $request->post();
        unset($infoclass['_method']);
        if ($infoclass['icname'] != ""&&$infoclass['icname'] != null) {
            if (inc::create($infoclass)) {
                $this->success('添加成功', url('admin/Infoclass/infoclassilyList',['id'=> 1]));
            } else {
                $this->error('添加失败');
            }
        } else {
            $this->error("添加失败，名称不能为空！");
        }
    }

    public function delete(Request $request)
    {
    	$id = $request->param('id');
    	$res = inc::destroy($id);
    	if ($res) {
    		$this->success('删除成功',url('admin/Infoclass/infoClassilyList',['id'=> 1]));
    	} else {
    		$this->error('删除失败');
    	}
    }

    public function update(Request $request)
    {
        $id = inc::find($request->param('id'));
        if($request->param('icname')!="" && $request->param('icname')!= null){
	        $res = $id->save([
	        	'icname' => $request->param('icname')
	        ]);
	        if ($res) {
	            $this->success('修改成功',url('admin/Infoclass/infoClassilyList',['id'=> $request->param('p')]),'',2);
	        } else {
	            $this->error('修改失败！');
	        }
	    }else {
	    	$this->error("修改失败，名称不能为空！");
	    }  
    }
}
?>