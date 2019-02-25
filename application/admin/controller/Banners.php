<?php 
namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Banners as ba;

class Banners extends Common
{
	public function bannerList(Request $request)
	{
		$id=$request->param('id')>0?$request->param('id'):1;
        $pre = $id>1?$id-1:1;
		$start=($id-1)*10; 
		$count = ba::count();
        $max=ceil($count/10);
        $next=$id<$max?$id+1:$max;
		// 查询数据
        $res = ba::order('border desc')->limit($start,10)->select();
        
        
        // 将数据分配到模板
        $this->assign('pre',$pre);
        $this->assign('next',$next);
        $this->assign('max',$max);
        $this->assign('id',$id);
        $this->assign('count', $count);
        $this->assign('res', $res);
		return $this->fetch('bannerList');
	}

	public function addBanner()
	{
		return $this->fetch('addBanner');
	}

	public function edit(Request $request)
	{
		$p = $request->param('p');
		$id = $request->param('id');
		$res = ba::find($id);
		$this->assign('p', $p);
		$this->assign('res', $res);
		return $this->fetch('edit');
	}

	public function insert(Request $request)
    {
        $banners = $request->post();
        unset($banners['_method']);
        $banners['bdate'] = date('Y-m-d H:i:s',time());
        $file = $request->file('bpic');
        if ($banners['burl'] != "") {
        }else {
            $this->error('添加失败,URL不能为空！');
        }
        if ($banners['btitle'] != "") {
        }else {
            $this->error('添加失败,标题不能为空！');
        }
        if ($file !="") {
		}else {
            $this->error('添加失败,图片不能为空！');
        }
        
        $res = $file->move(ROOT_PATH . 'public/uploads');
        $banners['bpic'] = '/uploads/'.$res->getSaveName();
        
        if(ba::create($banners)){
            $this->success('添加成功', url('admin/Banners/bannerList',['id'=> 1]));
        }else {
            $this->error('添加失败!');
        }
    }

    public function delete(Request $request)
    {
    	$id = $request->param('id');
    	$pic = ba::find($request->param('id'));
    	$bpic = $pic['bpic'];
    	unlink(ROOT_PATH . 'public' . DS .$bpic);
    	$res = ba::destroy($id);

    	if ($res) {
    		$this->success('删除成功',url('admin/Banners/bannerList',['id'=> 1]));
    	} else {
    		$this->error('删除失败');
    	}
    }

    public function border(Request $request)
    {
    	$res = $request->param();
        foreach ($res as $key => $value) {
        	foreach ($value as $k => $v) {
        	ba::where('bid' , $k)->update(['border' => $v]);
        }
        }
		if ($res) {
            $this->success('排序成功',url('admin/Banners/bannerList'));
        } else {
            $this->error('排序失败');
        }
    }

    public function update(Request $request)
    {
        $id = ba::find($request->param('id'));
        $pic = $request->param('pic');
        $file = $request->file('bpic');
        if($request->file('bpic')!=""){
            unlink(ROOT_PATH . 'public' . DS .$pic);
            $res= $file->move(ROOT_PATH . 'public/uploads');
            $bpic = '/uploads/'.$res->getSaveName();
        }else{
            $bpic = $pic;
        }
        if($request->param('burl')!=""&&$request->param('btitle')!=""){
	        $res2 = $id->save([
	        	'burl' => $request->param('burl'),
	        	'btitle' => $request->param('btitle'),
	        	'bpic' => $bpic,
	        	'bdate' => date('Y-m-d H:i:s',time())
	        ]);
	        if ($res2) {
	            $this->success('修改成功',url('admin/Banners/bannerList',['id'=> $request->param('p')]),'',2);
	        } else {
	            $this->error('修改失败');
	        }
	    }else {
	    	$this->error("修改失败，有数据为空！",url('admin/Banners/edit',['id' => $request->param('id'),'p'=> $request->param('p')]),'',2);
	    }  
    }
}
?>