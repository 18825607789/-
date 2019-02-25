<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// return [
//     '__pattern__' => [
//         'name' => '\w+',
//     ],
//     '[hello]'     => [
//         ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//         ':name' => ['index/hello', ['method' => 'post']],
//     ],

// ];


use think\Route;

Route::pattern([
	'id' => '\d+',
	'type' => '\w+'
]);

//后台首页
Route::get('/admin/index','admin/Index/index');
Route::get('/admin/logout','admin/Index/logout');
// 登录
Route::get('/admin/login','admin/Login/login');
Route::post('/admin/login','admin/Login/logindo');
//管路员
Route::get('/admin/admin/[:id]','admin/Admins/adminList');
// Route::get('/admin/delete/:id','admin/Admins/delete');
// Route::get('/admin/addadmin/:id','admin/Admins/addadmin');
Route::get('/admin/addadmin','admin/Admins/addAdmin');
Route::get('/admin/admin/edit/:id/:p','admin/Admins/edit');
//新闻
Route::get('/admin/new/[:id]','admin/News/newList');
Route::get('/admin/addnew','admin/News/addNew');
Route::get('/admin/news/edit/:id/:p','admin/News/edit');
//广告
Route::get('/admin/banner/[:id]','admin/Banners/bannerList');
Route::get('/admin/addbanner','admin/Banners/addBanner');
Route::get('/admin/banner/edit/:id/:p','admin/Banners/edit');
//产品
Route::get('/admin/product/[:id]','admin/Products/productList');
Route::get('/admin/addproduct','admin/Products/addProduct');
Route::get('/admin/product/edit/:id/:p','admin/Products/edit');
Route::get('/admin/productclassily/[:id]','admin/Productclass/productClassilyList');
Route::get('/admin/addproductclassily','admin/Productclass/addProductClassily');
Route::get('/admin/productclass/edit/:id/:p','admin/Productclass/edit');
// Route::get('/admin/productclass/delete/:id','admin/Productclass/delete');
//公司
Route::get('/admin/info/[:id]','admin/Info/infoList');
Route::get('/admin/addinfo','admin/Info/addInfo');
Route::get('/admin/info/edit/:id/:p','admin/Info/edit');
Route::get('/admin/infoclassily/[:id]','admin/Infoclass/infoClassilyList');
Route::get('/admin/addinfoclassily','admin/Infoclass/addInfoClassily');
Route::get('/admin/infoclass/edit/:id/:p','admin/Infoclass/edit');
//留言
Route::get('/admin/message/[:id]','admin/Message/messageList');
Route::get('/admin/checkmessage/:id/:p','admin/Message/checkMessage');
//论坛后台首页
Route::get('/admin/forumindex','admin/Index/forumIndex');
//用户
Route::get('/admin/user/[:id]','admin/Users/userList');
Route::get('/admin/checkuser/:id/:p','admin/Users/checkUser');
//版块
Route::get('/admin/block/[:id]','admin/Block/blockList');
Route::get('/admin/addblock','admin/Block/addBlock');
Route::get('/admin/block/edit/:id/:p','admin/Block/edit');
Route::get('/admin/blocktheme/[:id]','admin/Blocktheme/blockThemeList');
Route::get('/admin/addblocktheme','admin/Blocktheme/addBlockTheme');
Route::get('/admin/blocktheme/edit/:id/:p','admin/Blocktheme/edit');
//帖子
Route::get('/admin/post/[:id]','admin/Post/postList');
Route::get('/admin/checkpost/:id/:p','admin/Post/checkPost');
//回帖
Route::get('/admin/reply/[:id]','admin/Reply/replyList');
Route::get('/admin/checkreply/:id/:p','admin/Reply/checkReply');

//前台首页
Route::get('/','index/Index/index');
Route::get('/login','index/Index/login');
Route::get('/register','index/Index/register');
//联系我们
Route::get('/contact_us','index/Index/contact_us');
//公司
Route::get('/company_forum','index/Company/company_forum');
Route::get('/company_introduction','index/Company/company_introduction');
//论坛
Route::get('/forum_details','index/Forum/forum_details');
Route::get('/forum_help','index/Forum/forum_help');
Route::get('/forum_list','index/Forum/forum_list');
Route::get('/forum_search','index/Forum/forum_search');
Route::get('/member_center','index/Forum/member_center');
//新闻
Route::get('/news_detail','index/News/news_detail');
Route::get('/news_list','index/News/news_list');
Route::get('/profession_dynamic_detail','index/News/profession_dynamic_detail');
//产品
Route::get('/product_center','index/Product/product_center');
Route::get('/product_details','index/Product/product_details');