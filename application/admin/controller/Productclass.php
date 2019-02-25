<?php 
namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Productclass as prc;

class Productclass extends Common
{
	public function productClassilyList(Request $request)
	{
		$id=$request->param('id')>0?$request->param('id'):1;
        $pre = $id>1?$id-1:1;
		$start=($id-1)*10; 
		$count = prc::count();
        $max=ceil($count/10);
        $next=$id<$max?$id+1:$max;
		// 查询数据
        $res = prc::limit($start,10)->select();
        
        
        // 将数据分配到模板
        $this->assign('pre',$pre);
        $this->assign('next',$next);
        $this->assign('max',$max);
        $this->assign('id',$id);
        $this->assign('count', $count);
        $this->assign('res', $res);
		return $this->fetch('productClassilyList');
	}

    public function addProductClassily()
    {
        return $this->fetch('addProductClassily');
    }

    public function edit(Request $request)
    {
        $p = $request->param('p');
        $id = $request->param('id');
        $res = prc::find($id);
        $this->assign('p', $p);
        $this->assign('res', $res);
        return $this->fetch('edit');
    }

    public function insert(Request $request)
    {
        $productclass = $request->post();
        unset($productclass['_method']);
        if ($productclass['prcname'] != ""&&$productclass['prcname'] != null) {
            if (prc::create($productclass)) {
                $this->success('添加成功', url('admin/Productclass/productClassilyList',['id'=> 1]));
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
        $res = prc::destroy($id);
        if ($res) {
            $this->success('删除成功',url('admin/Productclass/productclassilyList',['id'=> 1]));
        } else {
            $this->error('删除失败');
        }
    }

    public function update(Request $request)
    {
        $id = prc::find($request->param('id'));
        if($request->param('prcname')!=""&&$request->param('prcname')!=null){
            $res = $id->save([
                'prcname' => $request->param('prcname')
            ]);
            if ($res) {
                $this->success('修改成功',url('admin/Productclass/productClassilyList',['id'=> $request->param('p')]),'',2);
            } else {
                $this->error('修改失败');
            }
        }else {
            $this->error("修改失败，名称不能为空！",url('admin/Productclass/edit',['id' => $request->param('id'),'p'=> $request->param('p')]),'',2);
        }  
    }
}
?>