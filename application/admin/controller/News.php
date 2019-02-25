<?php 
namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\News as ne;

class News extends Common
{
	public function newList(Request $request)
	{
		$id=$request->param('id')>0?$request->param('id'):1;
        $pre = $id>1?$id-1:1;
		$start=($id-1)*10; 
		$count = ne::count();
        $max=ceil($count/10);
        $next=$id<$max?$id+1:$max;
		// 查询数据
        $res = ne::limit($start,10)->select();
        
        
        // 将数据分配到模板
        $this->assign('pre',$pre);
        $this->assign('next',$next);
        $this->assign('max',$max);
        $this->assign('id',$id);
        $this->assign('count', $count);
        $this->assign('res', $res);
		return $this->fetch('newList');
	}

	public function addNew()
	{
		return $this->fetch('addNew');
	}

	public function edit(Request $request)
	{
		$p = $request->param('p');
		$id = $request->param('id');
		$res = ne::find($id);
		$this->assign('p', $p);
		$this->assign('res', $res);
		return $this->fetch('edit');
	}

	public function insert(Request $request)
    {
        $news = $request->post();
        unset($news['_method']);
        $file = $request->file('npic');
        $news['ndate'] = date('Y-m-d H:i:s',time());
        if ($news['ntitle'] != "") {
        }else {
            $this->error('添加失败,标题不能为空！');
        }
        if($news['nclass'] != ""){
		}else {
            $this->error('添加失败,类型不能为空！');
        }
        if ($file !="") {
        }else {
            $this->error('添加失败,图片不能为空！');
        }
        if ($news['ncontent'] !="") {
		}else {
            $this->error('添加失败,内容不能为空！');
        }
        $res = $file->move(ROOT_PATH . 'public/uploads');
        $news['npic'] = '/uploads/'.$res->getSaveName();
        $news['nauthor'] = session('aname');
        if(ne::create($news)){
            $this->success('添加成功', url('admin/News/newList',['id'=> 1]));
        }else {
            $this->error('添加失败!');
        }
    }

    public function delete(Request $request)
    {
    	$id = $request->param('id');
        $pic = ne::find($request->param('id'));
        $npic = $pic['npic'];
        unlink(ROOT_PATH . 'public' . DS .$npic);
    	$res = ne::destroy($id);

    	if ($res) {
    		$this->success('删除成功',url('admin/News/newList',['id'=> 1]));
    	} else {
    		$this->error('删除失败');
    	}
    }

    public function update(Request $request)
    {
        $id = ne::find($request->param('id'));
        $pic = $request->param('pic');
        $file = $request->file('npic');
        if($request->file('npic')!=""){
            unlink(ROOT_PATH . 'public' . DS .$pic);
            $res= $file->move(ROOT_PATH . 'public/uploads');
            $npic = '/uploads/'.$res->getSaveName();
        }else{
            $npic = $pic;
        }
        if($request->param('ntitle')!=""&&$request->param('nclass')!=""&&$request->param('ncontent')!=""){
	        $res2 = $id->save([
	        	'ntitle' => $request->param('ntitle'),
	        	'nclass' => $request->param('nclass'),
	        	'ncontent' => $request->param('ncontent'),
	        	'ndate' => date('Y-m-d H:i:s',time()),
                'npic' => $npic
	        ]);
	        if ($res2) {
	            $this->success('修改成功',url('admin/News/newList',['id'=> $request->param('p')]),'',2);
	        } else {
	            $this->error('修改失败');
	        }
	    }else {
	    	$this->error("修改失败，有数据为空！",url('admin/News/edit',['id' => $request->param('id'),'p'=> $request->param('p')]),'',2);
	    }  
    }
}
?>