<?php 
namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Blocktheme as blt;
use app\admin\model\Block as bl;

class Blocktheme extends Common
{
	public function blockThemeList(Request $request)
	{
		$id=$request->param('id')>0?$request->param('id'):1;
        $pre = $id>1?$id-1:1;
		$start=($id-1)*10; 
		$count = blt::count();
        $max=ceil($count/10);
        $next=$id<$max?$id+1:$max;
		// 查询数据
        $res = blt::limit($start,10)->select();
        $res2 = bl::select();
        $res3 = [];
        foreach ($res2 as $key => $value) {
        	$res3[$value->blid] = $value->blname;
        }
        
        
        // 将数据分配到模板
        $this->assign('pre',$pre);
        $this->assign('next',$next);
        $this->assign('max',$max);
        $this->assign('id',$id);
        $this->assign('count', $count);
        $this->assign('res', $res);
        $this->assign('res3', $res3);
		return $this->fetch('blockThemeList');
	}

	public function addBlockTheme()
	{
		$res = bl::select();
        $this->assign('res', $res);
		return $this->fetch('addBlockTheme');
	}

	public function edit(Request $request)
	{
		$p = $request->param('p');
		$id = $request->param('id');
		$res = blt::find($id);
		$res2 = bl::select();
		$this->assign('p', $p);
		$this->assign('res', $res);
		$this->assign('res2', $res2);
		return $this->fetch('edit');
	}

	public function insert(Request $request)
    {
        $blocktheme = $request->post();
        unset($blocktheme['_method']);
        if ($blocktheme['bltname'] != ""&& $blocktheme["bltname"]!=null) {
            if (blt::create($blocktheme)) {
                $this->success('添加成功', url('admin/Blocktheme/blockThemeList',['id'=> 1]));
            } else {
                $this->error('添加失败');
            }
        } else {
            $this->error("添加失败，主题名称不能为空！");
        }
    }

    public function delete(Request $request)
    {
    	$id = $request->param('id');
    	$res = blt::destroy($id);
    	if ($res) {
    		$this->success('删除成功',url('admin/Blocktheme/blockThemeList',['id'=> 1]));
    	} else {
    		$this->error('删除失败');
    	}
    }

    public function update(Request $request)
    {
        $id = blt::find($request->param('id'));
        if($request->param('bltname')!="" && $request->param('bltname')!= null){
	        $res = $id->save([
	        	'bltname' => $request->param('bltname'),
	        	'bltblid' => $request->param('bltblid')
	        ]);
	        if ($res) {
	            $this->success('修改成功',url('admin/Blocktheme/blockThemeList',['id'=> $request->param('p')]),'',2);
	        } else {
	            $this->error('修改失败！');
	        }
	    }else {
	    	$this->error("修改失败，主题名称不能为空！");
	    }  
    }
}
?>