-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2019 年 02 月 21 日 12:06
-- 服务器版本: 5.5.53
-- PHP 版本: 5.4.45

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `peck`
--

-- --------------------------------------------------------

--
-- 表的结构 `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `aid` int(11) NOT NULL AUTO_INCREMENT COMMENT '管理员id',
  `anumber` int(11) NOT NULL COMMENT '管理员账户',
  `aname` varchar(50) NOT NULL COMMENT '管理员名称',
  `alid` int(11) NOT NULL COMMENT '管理员权限id',
  `apwd` varchar(50) NOT NULL COMMENT '管理员密码',
  `apassword` varchar(50) NOT NULL COMMENT '确认密码',
  PRIMARY KEY (`aid`),
  UNIQUE KEY `anumber` (`anumber`,`aname`),
  UNIQUE KEY `anumber_2` (`anumber`,`aname`),
  UNIQUE KEY `aid` (`aid`),
  UNIQUE KEY `aid_2` (`aid`),
  UNIQUE KEY `aname_3` (`aname`),
  UNIQUE KEY `anumber_4` (`anumber`),
  KEY `anumber_3` (`anumber`),
  KEY `aid_3` (`aid`),
  FULLTEXT KEY `aname` (`aname`),
  FULLTEXT KEY `aname_2` (`aname`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `admins`
--

INSERT INTO `admins` (`aid`, `anumber`, `aname`, `alid`, `apwd`, `apassword`) VALUES
(1, 123, 'zhu', 1, '4545ec12dfebcb70043960aa74d17446', '4545ec12dfebcb70043960aa74d17446'),
(2, 1232, 'zhu2', 1, '4545ec12dfebcb70043960aa74d17446', '4545ec12dfebcb70043960aa74d17446'),
(3, 0, '', 1, 'd41d8cd98f00b204e9800998ecf8427e', 'd41d8cd98f00b204e9800998ecf8427e');

-- --------------------------------------------------------

--
-- 表的结构 `banners`
--

CREATE TABLE IF NOT EXISTS `banners` (
  `bid` int(11) NOT NULL AUTO_INCREMENT COMMENT '广告id',
  `btitle` varchar(50) NOT NULL COMMENT '广告标题',
  `bpic` varchar(255) NOT NULL COMMENT '广告图片',
  `border` int(11) DEFAULT NULL COMMENT '顺序',
  `burl` varchar(255) NOT NULL COMMENT '广告路径',
  `bdate` datetime NOT NULL COMMENT '发布日期',
  PRIMARY KEY (`bid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=24 ;

--
-- 转存表中的数据 `banners`
--

INSERT INTO `banners` (`bid`, `btitle`, `bpic`, `border`, `burl`, `bdate`) VALUES
(8, 'qwwqe', '/uploads/20180813\\467e0a3e9360fb0a6aed7696a8c007ea.jpg', 11, 'fvfewfew', '2018-08-13 13:10:30'),
(7, 'qwewqe', '/uploads/20180813\\a7285ed7219bdfb3684a2feb261446ea.jpg', 7, 'qwfqwdw', '2018-08-13 13:10:22'),
(6, 'wqeqw', '/uploads/20180813\\317c4c3a7fcea6b846b432c289a7fed1.jpg', 10, 'weqw', '2018-08-13 13:10:12'),
(9, 'qwsad', '/uploads/20180813\\36e00206be8cb7757fe0afe2c000b24a.jpg', 9, 'fwedwqd', '2018-08-13 13:10:44'),
(10, 'wqeqw', '/uploads/20180813\\25d1fedb56190e96a0698cf9ae30b084.jpg', 6, '123', '2018-08-13 13:11:00'),
(11, 'wqeqe', '/uploads/20180813\\ffb5eb72a317d0f13ec1c0fabb651fd6.jpg', 5, '123', '2018-08-13 13:11:10'),
(13, 'sdasdas', '/uploads/20180813\\029e9cc437e55e17d03dd64e5ed57c18.jpg', 4, 'dssfda', '2018-08-13 13:11:59'),
(14, 'sadsad', '/uploads/20180813\\a3ffb2becc006ba300a78e159050d0d6.jpg', 3, 'dsvdsd', '2018-08-13 13:12:10'),
(15, 'asds', '/uploads/20180813\\f4ed70366630f70fb18ff98dd34070f4.jpg', 2, 'vsdvsd', '2018-08-14 22:59:32'),
(16, 'sadasds', '/uploads/20180813\\138d24257087b414c8367661c1eccce0.jpg', 1, 'sadsad', '2018-08-13 22:20:59'),
(21, 'qweqw', '/uploads/20180813\\0ad48e92c3073da0caaaf11c8ee1faf2.jpg', 5, '2312', '2018-08-13 22:02:42'),
(22, 'dfsdf', '/uploads/20180813\\a049b3d291d29af8d5e16559281381f3.jpg', NULL, 'www', '2018-08-13 23:00:05'),
(23, 'eqds', '/uploads/20180813\\045bdd8732c1af27ae98f72d7defb99f.jpg', NULL, 'cscs', '2018-08-13 23:12:03');

-- --------------------------------------------------------

--
-- 表的结构 `block`
--

CREATE TABLE IF NOT EXISTS `block` (
  `blid` int(11) NOT NULL AUTO_INCREMENT COMMENT '版块id',
  `blname` varchar(50) NOT NULL COMMENT '版块名称',
  `bluid` int(11) NOT NULL COMMENT '分区版主用户id',
  PRIMARY KEY (`blid`),
  UNIQUE KEY `blname` (`blname`),
  UNIQUE KEY `blname_2` (`blname`),
  UNIQUE KEY `blname_3` (`blname`),
  UNIQUE KEY `blname_4` (`blname`),
  UNIQUE KEY `blname_5` (`blname`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `block`
--

INSERT INTO `block` (`blid`, `blname`, `bluid`) VALUES
(1, '都是大大', 2),
(2, '速度擦我擦', 1),
(3, '阿达', 2),
(4, '阿的啥啊是的我', 1);

-- --------------------------------------------------------

--
-- 表的结构 `blocktheme`
--

CREATE TABLE IF NOT EXISTS `blocktheme` (
  `bltid` int(11) NOT NULL AUTO_INCREMENT COMMENT '版块主题id',
  `bltname` varchar(50) NOT NULL COMMENT '版块主题名称',
  `bltblid` int(11) NOT NULL COMMENT '所属版块id',
  PRIMARY KEY (`bltid`),
  UNIQUE KEY `bltname` (`bltname`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `blocktheme`
--

INSERT INTO `blocktheme` (`bltid`, `bltname`, `bltblid`) VALUES
(1, '萨达萨', 1),
(2, '二号位', 2),
(3, '适合额', 3),
(4, 'dfsdfasdas', 1),
(5, 'vfasdasdfsadsa', 4);

-- --------------------------------------------------------

--
-- 表的结构 `info`
--

CREATE TABLE IF NOT EXISTS `info` (
  `iid` int(11) NOT NULL AUTO_INCREMENT COMMENT '信息id',
  `iicid` int(11) NOT NULL COMMENT '信息分类id',
  `icontent` text NOT NULL COMMENT '信息内容',
  PRIMARY KEY (`iid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `info`
--

INSERT INTO `info` (`iid`, `iicid`, `icontent`) VALUES
(2, 3, '<p>sandisahdikahdiwdkadiaskasdkwjfikaslfjaihfdiwlafkefkdI花里胡哨的客户hi而后可发生上海社会</p>\r\n'),
(3, 4, '<p>scasfcswafwa</p>\r\n');

-- --------------------------------------------------------

--
-- 表的结构 `infoclass`
--

CREATE TABLE IF NOT EXISTS `infoclass` (
  `icid` int(11) NOT NULL AUTO_INCREMENT COMMENT '信息分类id',
  `icname` varchar(50) NOT NULL COMMENT '信息分类名称',
  PRIMARY KEY (`icid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `infoclass`
--

INSERT INTO `infoclass` (`icid`, `icname`) VALUES
(1, 'sfasfsasd'),
(3, 'efefewdfe'),
(4, 'vdsds'),
(5, 'csdcvfasc');

-- --------------------------------------------------------

--
-- 表的结构 `level`
--

CREATE TABLE IF NOT EXISTS `level` (
  `lid` int(11) NOT NULL AUTO_INCREMENT,
  `lname` varchar(50) NOT NULL,
  PRIMARY KEY (`lid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `level`
--

INSERT INTO `level` (`lid`, `lname`) VALUES
(1, '超级管理员'),
(2, '公司管理员'),
(3, '论坛管理员');

-- --------------------------------------------------------

--
-- 表的结构 `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `mid` int(11) NOT NULL AUTO_INCREMENT COMMENT '留言id',
  `mname` varchar(50) NOT NULL COMMENT '留言游客名称',
  `mcontent` text NOT NULL COMMENT '留言内容',
  `mdate` date NOT NULL COMMENT '留言日期',
  `mtitle` varchar(50) NOT NULL COMMENT '留言标题',
  `memail` varchar(255) NOT NULL COMMENT '游客邮箱',
  `mphone` int(12) NOT NULL COMMENT '游客手机',
  `manswer` text COMMENT '回复内容',
  PRIMARY KEY (`mid`),
  UNIQUE KEY `mname` (`mname`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `message`
--

INSERT INTO `message` (`mid`, `mname`, `mcontent`, `mdate`, `mtitle`, `memail`, `mphone`, `manswer`) VALUES
(1, 'sdsada', 'sdasdsad', '2018-08-15', '', 'asdsd@qq.com', 0, NULL),
(2, 'dasdsdasda', 'sadvsadvedfwdasvsd', '2018-08-15', '', 'asdsd@qq.com', 0, NULL),
(4, '2we12e', 'sdfcawefwd', '2018-08-15', '', 'asdsd@qq.com', 1232312, '<p>SDASDASDASDSA</p>\r\n'),
(5, 'sasdd', 'sdsadasd', '2018-08-23', '', 'asdsd@qq.com', 412323, NULL),
(6, 'scdsvsd', 'vsdfdf', '2018-08-23', '', 'asdsd@qq.com', 123123, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `nid` int(11) NOT NULL AUTO_INCREMENT COMMENT '新闻id',
  `ntitle` varchar(255) NOT NULL COMMENT '新闻标题',
  `ndate` datetime NOT NULL COMMENT '发布日期',
  `ncontent` text NOT NULL COMMENT '新闻内容',
  `nclass` varchar(50) NOT NULL COMMENT '新闻类型',
  `npic` varchar(255) NOT NULL COMMENT '封面图片',
  `nauthor` varchar(50) NOT NULL COMMENT '新闻发布者',
  `nhit` int(11) NOT NULL DEFAULT '0' COMMENT '点击次数',
  PRIMARY KEY (`nid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=26 ;

--
-- 转存表中的数据 `news`
--

INSERT INTO `news` (`nid`, `ntitle`, `ndate`, `ncontent`, `nclass`, `npic`, `nauthor`, `nhit`) VALUES
(1, 'wweqw', '2018-08-13 01:23:36', '<p>fewWE</p>\r\n', '公司新闻', '', '', 0),
(2, '3214', '0000-00-00 00:00:00', '<p>qweqwwqr</p>\r\n', '0', '', '', 0),
(3, '4213wrqwe', '0000-00-00 00:00:00', '<p>asdasd</p>\r\n', '0', '', '', 0),
(4, 'fwef', '0000-00-00 00:00:00', '<p>EFwefwds</p>\r\n', '0', '', '', 0),
(5, 'fdasf', '0000-00-00 00:00:00', '<p>sfasddfwq</p>\r\n', '0', '', '', 0),
(6, 'wevfwcwe', '0000-00-00 00:00:00', '<p>wecwvaerva</p>\r\n', '0', '', '', 0),
(7, 'evea', '0000-00-00 00:00:00', '<p>awefawcedd</p>\r\n', '0', '', '', 0),
(8, 'asfdafas', '0000-00-00 00:00:00', '<p>fasfsafdsfsd</p>\r\n', '0', '', '', 0),
(9, 'dsfsdasg', '0000-00-00 00:00:00', '<p>dsfgwaegew</p>\r\n', '0', '', '', 0),
(10, 'fasfs', '0000-00-00 00:00:00', '<p>sdasfdsa</p>\r\n', '0', '', '', 0),
(12, 'asdasdd', '2018-08-12 21:37:20', '<p>safsfasf</p>\r\n', '0', '', '', 0),
(13, 'efgwefw', '2018-08-12 21:38:06', '<p>qwdqwfdw</p>\r\n', '1', '', '', 0),
(14, 'wdwqff', '2018-08-13 01:31:30', '<p>wdwfsafwwqdwq</p>\r\n', '公司新闻', '', '', 0),
(15, 'wdwfwqfe', '2018-08-13 01:31:10', '<p>fwqfwd</p>\r\n', '公司新闻', '', '', 0),
(16, 'vewefew', '2018-08-13 01:25:36', '<p>ewfweefawef</p>\r\n', '行业动态', '', '', 1),
(17, '3214', '2018-08-13 02:18:16', '<p>dsdasd</p>\r\n', '公司新闻', '', '', 0),
(18, 'dsda', '2018-08-13 23:15:20', '<p>sdasdsa</p>\r\n', '行业动态', '', '', 1),
(20, 'csfvawf', '2018-08-20 20:38:34', '<p>vevasfcd</p>\r\n', '公司新闻', '/uploads/20180820\\8b6e02b8e2fef66e59edc3555d7e6eee.png', '', 0),
(22, 'dfda', '2018-08-20 21:09:17', '<p>scafaefasdsa</p>\r\n', '公司新闻', '/uploads/20180820\\857bda9ef88e2888552f0150375fae15.png', '', 0),
(23, 'vdsfsd', '2018-08-23 15:41:47', '<p>asfasdasdsda</p>\r\n', '公司新闻', '/uploads/20180823\\ca0b34d0da823bd4501e42364cb438f0.png', '', 1),
(24, 'sfsfs', '2018-08-23 15:43:08', '<p>asasdasdsacascs</p>\r\n', '公司新闻', '/uploads/20180823\\9ab3ac01e7e4e1aefbbfaf4ffc806826.png', 'zhu', 8),
(25, 'dasfdsadsfs', '2018-08-23 16:09:35', '<p>sdasfassafsad</p>\r\n', '行业动态', '/uploads/20180823\\18052330a0928d209c1fd48ce6680f2f.png', 'zhu', 1);

-- --------------------------------------------------------

--
-- 表的结构 `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `pid` int(11) NOT NULL AUTO_INCREMENT COMMENT '帖子id',
  `puid` int(11) NOT NULL COMMENT '发帖用户id',
  `pblid` int(11) NOT NULL COMMENT '所属版块',
  `pbltid` int(11) NOT NULL COMMENT '所属版块主题',
  `pdate` datetime NOT NULL COMMENT '发布日期',
  `pcontent` text NOT NULL COMMENT '帖子内容',
  `ptitle` varchar(50) NOT NULL COMMENT '主题名称',
  `phit` int(11) NOT NULL DEFAULT '0' COMMENT '点击次数',
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `post`
--

INSERT INTO `post` (`pid`, `puid`, `pblid`, `pbltid`, `pdate`, `pcontent`, `ptitle`, `phit`) VALUES
(1, 2, 1, 1, '2018-08-16 00:00:00', 'asdsadsscs', 'qwew', 5),
(2, 1, 2, 2, '2018-08-16 00:00:00', 'swdsafcsa', 'edda', 1),
(3, 4, 2, 2, '2018-08-16 00:00:00', 'assafvasd', 'ewdq', 1),
(4, 4, 3, 3, '2018-08-16 00:00:00', 'asascdas', 'fewq', 1),
(5, 2, 3, 3, '2018-08-16 00:00:00', 'csaca', 'dsdaa', 0),
(7, 1, 1, 1, '2018-08-24 18:53:39', 'dsvfasdfasdsadsad', 'ddasd', 5),
(8, 1, 1, 1, '2018-08-24 18:55:01', 'dsvsdvdvsdvs', 'vsdasdfasfsafasf', 2),
(9, 1, 4, 5, '2018-08-24 18:55:42', 'vasdasdsadas', 'vsdfasdsfsad', 8),
(10, 2, 3, 3, '2018-08-24 19:29:33', 'sasvsddasdsfsdafdasdsadsadsa', 'sdfasfsafasdasd', 0),
(11, 2, 3, 3, '2018-08-24 19:30:17', 'sasvsddasdsfsdafdasdsadsadsa', 'sdfasfsafasdasd', 0),
(12, 1, 1, 1, '2018-08-24 21:59:34', 'vddsfasdadas', 'sdasdasdasfsdf', 0),
(13, 1, 1, 4, '2018-08-25 04:30:56', '大概发生的发生大时代文化大文化的发生的范围', 'V的沙发上发呆萨达萨达撒大', 1),
(14, 1, 4, 5, '2018-08-25 04:31:49', '是vc撒旦法大晚上的哇好大我还打算', '电话vs打哈哈伟大的是好事呵呵带我去', 1),
(15, 1, 1, 5, '2018-08-25 04:37:17', '嗯好的我和我', '喝我和我和我', 0);

-- --------------------------------------------------------

--
-- 表的结构 `productclass`
--

CREATE TABLE IF NOT EXISTS `productclass` (
  `prcid` int(11) NOT NULL AUTO_INCREMENT COMMENT '产品分类id',
  `prcname` varchar(50) NOT NULL COMMENT '产品名称',
  PRIMARY KEY (`prcid`),
  UNIQUE KEY `prname` (`prcname`),
  UNIQUE KEY `prcname` (`prcname`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `productclass`
--

INSERT INTO `productclass` (`prcid`, `prcname`) VALUES
(1, '威武'),
(2, 'sds'),
(8, 'sdasd'),
(4, '?'),
(5, 'dfsdfds'),
(7, 'dfsd'),
(9, 'dvsddcs'),
(10, 'dvdwdasxs'),
(11, 'sdsd'),
(12, 'asdascacs'),
(13, 'vdscasd'),
(14, 'ijijiojio'),
(16, 'dsfawdwd');

-- --------------------------------------------------------

--
-- 表的结构 `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `prid` int(11) NOT NULL AUTO_INCREMENT COMMENT '产品id',
  `prnumber` varchar(50) NOT NULL COMMENT '产品型号',
  `prname` varchar(50) NOT NULL COMMENT '产品名称',
  `prpic` varchar(255) NOT NULL COMMENT '产品图片',
  `prprcid` int(11) NOT NULL COMMENT '产品分类id',
  `prmaterial` varchar(50) NOT NULL COMMENT '产品材质',
  `prsize` varchar(50) NOT NULL COMMENT '产品尺寸',
  `prfit` varchar(50) NOT NULL COMMENT '适用于',
  `prstyle` varchar(50) NOT NULL COMMENT '产品风格',
  `prsynopsis` text NOT NULL COMMENT '产品简介',
  `prsid` int(11) NOT NULL COMMENT '产品类型',
  PRIMARY KEY (`prid`),
  UNIQUE KEY `prnumber` (`prnumber`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `products`
--

INSERT INTO `products` (`prid`, `prnumber`, `prname`, `prpic`, `prprcid`, `prmaterial`, `prsize`, `prfit`, `prstyle`, `prsynopsis`, `prsid`) VALUES
(1, 'e3eqw3', '按时打算', '/uploads/20180814\\8f96ff0d1481eeda05f80b89d9a79da5.png', 1, 'wewq', 'qwe', '卧室', '简约', '<p>sfwafwdad</p>\r\n', 1),
(3, 'efwefw', 'fwefw', '/uploads/20180814\\2da3123f3c84f70b1ad3de2df214f167.png', 1, 'wefwe', 'efwef', '卧室', '简约', '<p>wefwefw</p>\r\n', 1),
(4, 'efwafe', 'efawefe', '/uploads/20180814\\0389e7d74a8c822a60bb09195064096c.png', 4, 'wefaewdf', 'sdfds', '卧室', '简约', '<p>sdfsdfsdf</p>\r\n', 1),
(5, 'sdfsd', 'sdfasdf', '/uploads/20180814\\1173791974b886c20e048b01e77ff039.png', 4, 'sdfasdf', 'sdfsdf', '0', '0', '<p>vsdwefwe</p>\r\n', 1),
(7, 'fwefwdwd', 'vewvew', '/uploads/20180820\\40182ed7d0e3d192bed5de806ab95f2a.png', 4, 'asdqwdw', 'asdad', '0', '0', '<p>sfwqfcsdc</p>\r\n', 1),
(8, 'scascas', 'efadsds', '/uploads/20180823\\c619d7882e534d97381771caf7207149.jpg', 4, 'scasd', 'sadasdas', '0', '0', '<p>cascasd</p>\r\n', 2),
(9, 'sdsads', 'sadsadaf', '/uploads/20180823\\747348cf63bf18643baa1a75ef5af62b.png', 4, 'asdsda', 'asds', '0', '0', '<p>sadasdasdw</p>\r\n', 1),
(10, 'vsddcc', 'vasdscs', '/uploads/20180823\\8357ed95012799c85161d9093b7cc259.jpg', 4, 'wdcdsc', 'asdwds', '卧室', '简约', '<p>vdfwfwef</p>\r\n', 1),
(11, 'bsdfsac', 'bdfgesfasdc', '/uploads/20180823\\48da33b6408c96cced0535231cf5599c.jpg', 4, 'asdsadf', 'dsvsdc', '卧室', '简约', '<p>vbSZXcaswfcasc</p>\r\n', 1),
(12, 'dsfdfawsf', 'bsdassSA', '/uploads/20180823\\381584dc00f2564bc212a233d0e2151d.jpg', 1, 'sfwesfdscfsd', 'sdfesfcsdc', '0', '0', '<p>sdfesadfsdcdxzcds</p>\r\n', 1),
(13, 'dsvzSDcds', 'bdfzsfddsvsd', '/uploads/20180823\\978b12b177741966e83b6b6a3cb74e7e.jpg', 1, 'sdfAWsda', 'asfdsdcvsd', '0', '0', '<p>dvfdzasfdesw</p>\r\n', 1),
(14, 'fbsdsa', 'bfdfsafds', '/uploads/20180823\\206c685fe7867ca11fbba8fd9aa02b34.jpg', 1, 'asfdsvsd', 'sfszdcd', '0', '0', '<p>bdzfzzsdcsdxc</p>\r\n', 1),
(15, 'bsdfzdfsc', 'bvdfsfsacfds', '/uploads/20180823\\d0dce27fcb6fef000a093e9f6694b2e8.jpg', 1, 'asfdvzsdvc', 'wdwdfsde', '0', '0', '<p>bfdfzsfdwcsdc</p>\r\n', 1),
(16, 'bdzffdcsd', 'bdfzdscsacd', '/uploads/20180823\\801e2b4f8456adad08915ec156abc736.jpg', 1, 'zsdwadcdsc', 'sdfaXscdxc', '0', '0', '<p>dfbfdzsfcsac</p>\r\n', 1),
(17, 'asds', 'scasd', '/uploads/20180824\\1e65505b98c2d0da10e850acf6d22427.jpg', 1, 'asdsdsa', 'sdasdasd', '0', '0', '<p>safasfasdsdasdsafasddsa</p>\r\n', 1);

-- --------------------------------------------------------

--
-- 表的结构 `reply`
--

CREATE TABLE IF NOT EXISTS `reply` (
  `rid` int(11) NOT NULL AUTO_INCREMENT COMMENT '回帖id',
  `ruid` int(11) NOT NULL COMMENT '回帖用户id',
  `rpid` int(11) NOT NULL COMMENT '所属帖子id',
  `rdate` datetime NOT NULL COMMENT '回帖日期',
  `rtitle` varchar(50) NOT NULL COMMENT '回帖标题',
  `rcontent` text NOT NULL COMMENT '回帖内容',
  PRIMARY KEY (`rid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `reply`
--

INSERT INTO `reply` (`rid`, `ruid`, `rpid`, `rdate`, `rtitle`, `rcontent`) VALUES
(1, 2, 2, '2018-08-16 00:00:00', '哈我打我的', '的哇打我打'),
(2, 1, 3, '2018-08-16 00:00:00', '打撒大撒', '啥单位签订'),
(5, 1, 9, '2018-08-24 22:09:31', '', 'sdsdsadsadsadsdsadasdfcdsfasd'),
(6, 1, 9, '2018-08-24 22:10:08', '', 'sdsdsadsadsadsdsadasdfcdsfasd');

-- --------------------------------------------------------

--
-- 表的结构 `show`
--

CREATE TABLE IF NOT EXISTS `show` (
  `sid` int(11) NOT NULL AUTO_INCREMENT COMMENT '展示id',
  `sclass` varchar(50) NOT NULL COMMENT '展示类型',
  PRIMARY KEY (`sid`),
  UNIQUE KEY `sclass` (`sclass`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `show`
--

INSERT INTO `show` (`sid`, `sclass`) VALUES
(1, '热门'),
(2, '推荐');

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `uname` varchar(50) NOT NULL COMMENT '用户名称',
  `uvalidate` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否验证',
  `udate` datetime NOT NULL COMMENT '注册日期',
  `upwd` varchar(50) NOT NULL COMMENT '用户密码',
  `upassword` varchar(50) NOT NULL COMMENT '确认密码',
  `usex` varchar(50) NOT NULL DEFAULT '男' COMMENT '性别',
  `uage` int(11) DEFAULT NULL COMMENT '年龄',
  `uphone` int(11) DEFAULT NULL COMMENT '用户手机',
  `ubltid` int(11) DEFAULT NULL COMMENT '所属版块主题id',
  `uemail` varchar(255) NOT NULL COMMENT '用户邮箱',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uname` (`uname`),
  UNIQUE KEY `unumber` (`uname`,`uphone`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`uid`, `uname`, `uvalidate`, `udate`, `upwd`, `upassword`, `usex`, `uage`, `uphone`, `ubltid`, `uemail`) VALUES
(1, 'sdasd', 0, '2018-08-16 00:00:00', '202cb962ac59075b964b07152d234b70', '202cb962ac59075b964b07152d234b70', '女', 23, 1324242, 1, 'asd@qq.com'),
(2, 'qweqwe', 0, '2018-08-16 00:00:00', '123', '123', '1', NULL, NULL, NULL, ''),
(4, 'weqwe', 0, '2018-08-16 00:00:00', '123', '123', '1', NULL, NULL, NULL, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
