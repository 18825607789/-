<?php 
namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Message as me;
use think\Validate;

class Message extends Common
{
	public function messageList(Request $request)
	{
		$id=$request->param('id')>0?$request->param('id'):1;
        $pre = $id>1?$id-1:1;
		$start=($id-1)*10; 
		$count = me::count();
        $max=ceil($count/10);
        $next=$id<$max?$id+1:$max;
		// 查询数据
        $res = me::limit($start,10)->select();
        
        
        // 将数据分配到模板
        $this->assign('pre',$pre);
        $this->assign('next',$next);
        $this->assign('max',$max);
        $this->assign('id',$id);
        $this->assign('count', $count);
        $this->assign('res', $res);
		return $this->fetch('messageList');
	}

	public function checkMessage(Request $request)
	{
		$p = $request->param('p');
		$id = $request->param('id');
		$res = me::find($id);
		$this->assign('p', $p);
		$this->assign('res', $res);
		return $this->fetch('checkMessage');
	}

	public function answerMessage(Request $request)
	{
		$p = $request->param('p');
		$id = $request->param('id');
		$res = me::find($id);
		$this->assign('p', $p);
		$this->assign('res', $res);
		return $this->fetch('answerMessage');
	}

	public function insert(Request $request)
    {
        $message = $request->post();
        unset($message['_method']);
        $message['mdate'] = date('Y-m-d H:i:s',time());
        $captcha = new \think\captcha\Captcha();
        $result=$captcha->check($message['checkno']);
        if (Validate::is($message['memail'],'email')) {
        	if($result===true){
        		unset($message['checkno']);
        		if ($message['mname'] != ""&&$message['mphone'] != ""&&$message['mcontent'] != "") {
            		if (me::create($message)) {
                		$this->success('提交成功！');
            		} else {
                		$this->error('提交失败！');
            		}
        		} else {
            		$this->error("提交失败，有数据为空！");
        		}
        	}else{
        		$this->error("提交失败，验证码错误！");
        	}
        }else {
        	$this->error('提交失败，邮箱格式不正确！');
        }
        
    }

	public function delete(Request $request)
    {
    	$id = $request->param('id');

    	$res = me::destroy($id);

    	if ($res) {
    		$this->success('删除成功',url('admin/Message/messageList',['id'=> 1]));
    	} else {
    		$this->error('删除失败');
    	}
    }

    public function update(Request $request)
    {
        $id = me::find($request->param('id'));
        if($request->param('manswer')!=""&&$request->param('manswer')!=null){
	        $res = $id->save([
	        	'manswer' => $request->param('manswer'),
	        ]);
	        if ($res) {
	            $this->success('回复成功！',url('admin/Message/messageList',['id'=> $request->param('p')]),'',2);
	        } else {
	            $this->error('回复失败！');
	        }
	    }else {
	    	$this->error("回复失败，内容为空！");
	    }  
    }
}
?>