<?php 
namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Products as pr;
use app\admin\model\Productclass as prc;

class Products extends Common
{
	public function productList(Request $request)
	{
		$id=$request->param('id')>0?$request->param('id'):1;
        $pre = $id>1?$id-1:1;
		$start=($id-1)*10; 
		$count = pr::count();
        $max=ceil($count/10);
        $next=$id<$max?$id+1:$max;
		// 查询数据
        $res = pr::limit($start,10)->select();
        $res2 = prc::select();
        foreach ($res2 as $key => $value) {
        	$res3[$value->prcid] = $value->prcname;
        }
        
        // 将数据分配到模板
        $this->assign('pre',$pre);
        $this->assign('next',$next);
        $this->assign('max',$max);
        $this->assign('id',$id);
        $this->assign('count', $count);
        $this->assign('res', $res);
        $this->assign('res3', $res3);
		return $this->fetch('productList');
	}

	public function addProduct()
	{
		$res = prc::select();
        $this->assign('res', $res);
		return $this->fetch('addProduct');
	}

	public function edit(Request $request)
	{
		$p = $request->param('p');
		$id = $request->param('id');
		$res = pr::find($id);
		$res2 = prc::select();
		$this->assign('p', $p);
		$this->assign('res', $res);
		$this->assign('res2', $res2);
        
		return $this->fetch('edit');
	}

	public function insert(Request $request)
    {
        $product = $request->post();
        unset($product['_method']);
        $file = $request->file('prpic');
        if ($product['prname'] != "") {
        }else {
            $this->error('添加失败,名称不能为空！');
        }
        if ($product['prsid'] != "") {
        }else {
            $this->error('添加失败,展示类型不能为空！');
        }
        if ($product['prprcid'] != "") {
        }else {
            $this->error('添加失败,产品类型不能为空！');
        }
        if ($file !="") {
		}else {
            $this->error('添加失败,图片不能为空！');
        }
        if ($product['prnumber'] != "") {
        }else {
            $this->error('添加失败,货号不能为空！');
        }
        if ($product['prmaterial'] != "") {
        }else {
            $this->error('添加失败,材质不能为空！');
        }
        if ($product['prsize'] != "") {
        }else {
            $this->error('添加失败,尺寸不能为空！');
        }
        if ($product['prfit'] != "") {
        }else {
            $this->error('添加失败,适用类型不能为空！');
        }
        if ($product['prstyle'] != "") {
        }else {
            $this->error('添加失败,风格形式不能为空！');
        }
        if ($product['prsynopsis'] != "") {
        }else {
            $this->error('添加失败,产品简介不能为空！');
        }       
        $res = $file->move(ROOT_PATH . 'public/uploads');
        $product['prpic'] = '/uploads/'.$res->getSaveName();
        
        if(pr::create($product)){
            $this->success('添加成功', url('admin/Products/productList',['id'=> 1]));
        }else {
            $this->error('添加失败!');
        }
    }

    public function delete(Request $request)
    {
    	$id = $request->param('id');
    	$pic = pr::find($request->param('id'));
    	$prpic = $pic['prpic'];
    	unlink(ROOT_PATH . 'public' . DS .$prpic);
    	$res = pr::destroy($id);

    	if ($res) {
    		$this->success('删除成功',url('admin/Products/productList',['id'=> 1]));
    	} else {
    		$this->error('删除失败');
    	}
    }

    public function update(Request $request)
    {
        $id = pr::find($request->param('id'));
        $pic = $request->param('pic');
        $file = $request->file('prpic');
        if($request->file('prpic')!=""){
        	unlink(ROOT_PATH . 'public' . DS .$pic);
        	$res= $file->move(ROOT_PATH . 'public/uploads');
        	$prpic = '/uploads/'.$res->getSaveName();
        }else{
        	$prpic = $pic;
        }
        if($request->param('prname')!=""&&$request->param('prnumber')!=""&&$request->param('prmaterial')!=""&&$request->param('prsize')!=""&&$request->param('prsynopsis')!=""){
	        $res2 = $id->save([
	        	'prname' => $request->param('prname'),
	        	'prsid' => $request->param('prsid'),
	        	'prprcid' => $request->param('prprcid'),
	        	'prnumber' => $request->param('prnumber'),
	        	'prmaterial' => $request->param('prmaterial'),
	        	'prsize' => $request->param('prsize'),
	        	'prfit' => $request->param('prfit'),
	        	'prstyle' => $request->param('prstyle'),
	        	'prsynopsis' => $request->param('prsynopsis'),
	        	'prpic' => $prpic
	        ]);
	        if ($res2) {
	            $this->success('修改成功',url('admin/Products/productList',['id'=> $request->param('p')]),'',2);
	        } else {
	            $this->error('修改失败');
	        }
	    }else {
	    	$this->error("修改失败，有数据为空！",url('admin/Products/edit',['id' => $request->param('id'),'p'=> $request->param('p')]),'',2);
	    }  
    }
}
?>