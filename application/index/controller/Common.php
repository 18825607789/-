<?php
namespace app\index\controller;

use think\Controller;

class Common extends Controller
{
    public function _initialize()
    {
  //       //连接数据库
		// mysql_connect("localhost","root","root");
		// //选择数据库
		// mysql_select_db("peck");
		// mysql_query("set character_set_connection=utf8, character_set_results=utf8,character_set_client=binary");
	}
}
?>