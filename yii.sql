-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 01 月 17 日 01:31
-- 服务器版本: 5.5.20
-- PHP 版本: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `yii`
--

-- --------------------------------------------------------

--
-- 表的结构 `v_admin`
--

CREATE TABLE IF NOT EXISTS `v_admin` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `group_id` int(2) DEFAULT '0',
  `audit` int(1) DEFAULT '1',
  `name` varchar(100) DEFAULT NULL,
  `gender` int(1) DEFAULT '0',
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `last_login_time` int(10) NOT NULL DEFAULT '0',
  `last_logout_time` int(10) NOT NULL DEFAULT '0',
  `login_times` int(10) NOT NULL DEFAULT '0',
  `create_time` int(10) NOT NULL DEFAULT '0',
  `update_time` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `v_admin`
--

INSERT INTO `v_admin` (`id`, `username`, `password`, `group_id`, `audit`, `name`, `gender`, `email`, `phone`, `address`, `last_login_time`, `last_logout_time`, `login_times`, `create_time`, `update_time`) VALUES
(1, 'admin', 'admin1234', 1, 1, '超级管理员', 0, 'Mteddy@126.com', '15814449926', '中国', 1389922294, 1389782265, 1256, 1328864440, 1389782265),
(2, 'Teddy', '123456', 2, 1, '熊进超', 0, NULL, NULL, NULL, 1389760847, 1389761044, 14, 1380104029, 1389761044);

-- --------------------------------------------------------

--
-- 表的结构 `v_advertisement`
--

CREATE TABLE IF NOT EXISTS `v_advertisement` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `link` varchar(150) DEFAULT NULL,
  `advertising` int(10) NOT NULL DEFAULT '1',
  `photo1` varchar(100) DEFAULT NULL,
  `code` text,
  `audit` int(1) DEFAULT '0',
  `deadline` int(15) NOT NULL DEFAULT '0',
  `create_date` int(15) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- 转存表中的数据 `v_advertisement`
--

INSERT INTO `v_advertisement` (`id`, `name`, `link`, `advertising`, `photo1`, `code`, `audit`, `deadline`, `create_date`) VALUES
(1, '北京旅游', 'http://beijing.travel-cn.net/', 1, 'upload/advertisement/20120902083800168.jpg', '', 1, 1577865600, 1336147508),
(2, '丽江旅游', 'http://lijiang.travel-cn.net/', 1, 'upload/advertisement/20120902084136353.jpg', '', 1, 1577865600, 1336574871),
(3, '桂林旅游', 'http://guilin.travel-cn.net/', 1, 'upload/advertisement/20120902082130593.jpg', '', 1, 1577865600, 1336147586),
(4, '梦想西藏', 'http://xizang.travel-cn.net/', 1, 'upload/advertisement/20120902072350965.jpg', '', 1, 1577865600, 1336574907),
(5, '畅游香港', 'http://xianggang.travel-cn.net/', 1, 'upload/advertisement/20120902065618187.jpg', '', 1, 1577865600, 1336147724),
(6, '北京故宫一日游', 'http://www.travel-cn.net/', 2, 'upload/advertisement/201111/20111106062111772.jpg', '', 1, 1577836800, 1336574890),
(7, '深圳一日游', 'http://xiayizhan.travel-cn.net/route/30.html', 2, 'upload/advertisement/201111/20111106062458843.jpg', '', 1, 1577865600, 1320564211),
(8, '万里长城一日游', 'http://www.travel-cn.net/', 2, 'upload/advertisement/201111/20111106063343473.jpg', '', 1, 1577836800, 1320561223),
(9, '广西桂林山水一日游', 'http://guilinyoo.travel-cn.net/route/19.html', 2, 'upload/advertisement/201111/20111106063129807.jpg', '', 1, 1577865600, 1320564200),
(10, '深圳东部华侨城二日游', 'http://www.travel-cn.net/', 3, 'upload/advertisement/201111/20111106065522631.jpg', '', 1, 1577865600, 1320564185),
(11, '厦门鼓浪屿一日游', 'http://www.travel-cn.net/', 3, 'upload/advertisement/201111/20111106070108408.jpg', '', 1, 1577836800, 1320562868),
(12, '凤凰古城二日游', 'http://nh1766.travel-cn.net/route/51.html', 3, 'upload/advertisement/201111/20111106070305164.jpg', '', 1, 1577865600, 1320562985),
(13, '西双版纳五日游', 'http://www.travel-cn.net/', 3, 'upload/advertisement/201111/20111106070614681.jpg', '', 1, 1577865600, 1320563174),
(14, '拉萨七日游', 'http://www.travel-cn.net/', 4, 'upload/advertisement/201111/20111106072015446.jpg', '', 1, 1577836800, 1320564015),
(15, '香港五日游', 'http://www.travel-cn.net/', 4, 'upload/advertisement/201111/20111106072059827.jpg', '', 1, 1577865600, 1320564059),
(16, '神农架三日游', 'http://www.travel-cn.net/', 4, 'upload/advertisement/201111/20111106072135156.jpg', '', 1, 1577865600, 1320564095),
(17, '澳门十日游', 'http://www.travel-cn.net/', 4, 'upload/advertisement/201111/20111106072205597.jpg', '', 1, 1577865600, 1320564148),
(18, '嘉兴旅游', 'http://jiaxing.travel-cn.net/', 5, 'upload/advertisement/20120610040128535.jpg', '', 1, 1577865600, 1329399264),
(19, '重庆旅游', 'http://chongqing.travel-cn.net/', 5, 'upload/advertisement/20120610040142831.jpg', '', 1, 1577865600, 1329399268),
(20, '桂林旅游', 'http://guilin.travel-cn.net/', 5, 'upload/advertisement/20120610040151939.jpg', '', 1, 1577865600, 1329399272),
(21, '游遍中国之首都北京', 'http://beijing.travel-cn.net/travel/39.html', 6, 'upload/advertisement/20120603180318691.jpg', '', 1, 1577865600, 1338775398),
(22, '长沙到重庆七天游', 'http://chongqing.travel-cn.net/travel/170.html', 6, 'upload/advertisement/20120603180614866.jpg', '', 1, 1577865600, 1338775574);

-- --------------------------------------------------------

--
-- 表的结构 `v_advertising`
--

CREATE TABLE IF NOT EXISTS `v_advertising` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `lft` int(10) DEFAULT '0',
  `rgt` int(10) DEFAULT '0',
  `parent` int(10) DEFAULT '0',
  `depth` int(10) DEFAULT '1',
  `audit` int(1) NOT NULL DEFAULT '1',
  `size` varchar(20) DEFAULT NULL,
  `description` varchar(255) NOT NULL DEFAULT '',
  `create_date` varchar(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `v_advertising`
--

INSERT INTO `v_advertising` (`id`, `name`, `lft`, `rgt`, `parent`, `depth`, `audit`, `size`, `description`, `create_date`) VALUES
(1, '首页Banner广告', 1, 2, 0, 1, 1, '344*158', '', '1320416986'),
(2, '推荐线路-热门', 3, 4, 0, 1, 1, '135*80', '', '1320560206'),
(3, '推荐线路-推荐', 5, 6, 0, 1, 1, '135*80', '', '1320560229'),
(4, '推荐线路-优惠', 7, 8, 0, 1, 1, '135*80', '', '1320560252'),
(5, '线路页Banner广告', 9, 10, 0, 1, 1, '398*160', '', '1329398947'),
(6, '旅游攻略左侧广告', 11, 12, 0, 1, 1, '200*105', '', '1338774765');

-- --------------------------------------------------------

--
-- 表的结构 `v_article`
--

CREATE TABLE IF NOT EXISTS `v_article` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `leaf_id` int(10) DEFAULT NULL,
  `content` text,
  `audit` int(11) DEFAULT '0',
  `hot` int(1) DEFAULT '0',
  `recommend` int(1) DEFAULT '0',
  `photo1` varchar(120) NOT NULL,
  `photo2` varchar(120) NOT NULL,
  `hit` int(10) DEFAULT '0',
  `source` varchar(100) DEFAULT NULL,
  `source_url` varchar(120) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `create_time` int(10) NOT NULL DEFAULT '0',
  `update_time` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `v_article`
--

INSERT INTO `v_article` (`id`, `title`, `leaf_id`, `content`, `audit`, `hot`, `recommend`, `photo1`, `photo2`, `hit`, `source`, `source_url`, `description`, `keyword`, `create_time`, `update_time`) VALUES
(1, '我想去桂林', 3, '测试', 1, 1, 1, '/upload/image/article/201401/20140115093846_95951.jpg', '/upload/image/article/201311/20131105105143_58466.jpg', 0, '百度', 'http://www.baidu.com/', NULL, NULL, 1380176806, 1389778729);

-- --------------------------------------------------------

--
-- 表的结构 `v_auth_assignment`
--

CREATE TABLE IF NOT EXISTS `v_auth_assignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `v_auth_assignment`
--

INSERT INTO `v_auth_assignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('超级管理员', '1', NULL, 'N;');

-- --------------------------------------------------------

--
-- 表的结构 `v_auth_item`
--

CREATE TABLE IF NOT EXISTS `v_auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `v_auth_item`
--

INSERT INTO `v_auth_item` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('超级管理员', 2, '', NULL, 'N;'),
('siteIndex', 0, '系统设置访问', NULL, 'N;'),
('siteList', 0, '系统设置列表', NULL, 'N;'),
('siteEdit', 0, '系统设置编辑', NULL, 'N;'),
('siteAudit', 0, '系统设置审核', NULL, 'N;'),
('siteAuditAll', 0, '系统设置批量审核', NULL, 'N;'),
('siteUnAuditAll', 0, '系统设置批量不审核', NULL, 'N;'),
('siteHot', 0, '系统设置置热', NULL, 'N;'),
('siteRecommend', 0, '系统设置推荐', NULL, 'N;'),
('siteMoveUp', 0, '系统设置排序上移', NULL, 'N;'),
('siteMoveDown', 0, '系统设置排序下移', NULL, 'N;'),
('masterIndex', 0, '站长信息访问', NULL, 'N;'),
('masterList', 0, '站长信息列表', NULL, 'N;'),
('masterEdit', 0, '站长信息编辑', NULL, 'N;'),
('masterAudit', 0, '站长信息审核', NULL, 'N;'),
('masterAuditAll', 0, '站长信息批量审核', NULL, 'N;'),
('masterUnAuditAll', 0, '站长信息批量不审核', NULL, 'N;'),
('masterHot', 0, '站长信息置热', NULL, 'N;'),
('masterRecommend', 0, '站长信息推荐', NULL, 'N;'),
('masterMoveUp', 0, '站长信息排序上移', NULL, 'N;'),
('masterMoveDown', 0, '站长信息排序下移', NULL, 'N;'),
('databaseIndex', 0, '数 据 库访问', NULL, 'N;'),
('databaseList', 0, '数 据 库列表', NULL, 'N;'),
('databaseEdit', 0, '数 据 库编辑', NULL, 'N;'),
('databaseAudit', 0, '数 据 库审核', NULL, 'N;'),
('databaseAuditAll', 0, '数 据 库批量审核', NULL, 'N;'),
('databaseUnAuditAll', 0, '数 据 库批量不审核', NULL, 'N;'),
('databaseHot', 0, '数 据 库置热', NULL, 'N;'),
('databaseRecommend', 0, '数 据 库推荐', NULL, 'N;'),
('databaseMoveUp', 0, '数 据 库排序上移', NULL, 'N;'),
('databaseMoveDown', 0, '数 据 库排序下移', NULL, 'N;'),
('adminIndex', 0, '管 理 员访问', NULL, 'N;'),
('adminList', 0, '管 理 员列表', NULL, 'N;'),
('adminCreat', 0, '管 理 员创建', NULL, 'N;'),
('adminEdit', 0, '管 理 员编辑', NULL, 'N;'),
('adminAudit', 0, '管 理 员审核', NULL, 'N;'),
('adminAuditAll', 0, '管 理 员批量审核', NULL, 'N;'),
('adminUnAuditAll', 0, '管 理 员批量不审核', NULL, 'N;'),
('adminHot', 0, '管 理 员置热', NULL, 'N;'),
('adminRecommend', 0, '管 理 员推荐', NULL, 'N;'),
('adminMoveUp', 0, '管 理 员排序上移', NULL, 'N;'),
('adminMoveDown', 0, '管 理 员排序下移', NULL, 'N;'),
('adminDelete', 0, '管 理 员删除', NULL, 'N;'),
('adminDeleteAll', 0, '管 理 员批量删除', NULL, 'N;'),
('authorityIndex', 0, '权限分配访问', NULL, 'N;'),
('authorityList', 0, '权限分配列表', NULL, 'N;'),
('authorityEdit', 0, '权限分配编辑', NULL, 'N;'),
('authorityAudit', 0, '权限分配审核', NULL, 'N;'),
('authorityAuditAll', 0, '权限分配批量审核', NULL, 'N;'),
('authorityUnAuditAll', 0, '权限分配批量不审核', NULL, 'N;'),
('authorityHot', 0, '权限分配置热', NULL, 'N;'),
('authorityRecommend', 0, '权限分配推荐', NULL, 'N;'),
('authorityMoveUp', 0, '权限分配排序上移', NULL, 'N;'),
('authorityMoveDown', 0, '权限分配排序下移', NULL, 'N;'),
('memberIndex', 0, '普通会员访问', NULL, 'N;'),
('memberList', 0, '普通会员列表', NULL, 'N;'),
('memberCreat', 0, '普通会员创建', NULL, 'N;'),
('memberEdit', 0, '普通会员编辑', NULL, 'N;'),
('memberAudit', 0, '普通会员审核', NULL, 'N;'),
('memberAuditAll', 0, '普通会员批量审核', NULL, 'N;'),
('memberUnAuditAll', 0, '普通会员批量不审核', NULL, 'N;'),
('memberHot', 0, '普通会员置热', NULL, 'N;'),
('memberRecommend', 0, '普通会员推荐', NULL, 'N;'),
('memberMoveUp', 0, '普通会员排序上移', NULL, 'N;'),
('memberMoveDown', 0, '普通会员排序下移', NULL, 'N;'),
('memberDelete', 0, '普通会员删除', NULL, 'N;'),
('memberDeleteAll', 0, '普通会员批量删除', NULL, 'N;'),
('menuIndex', 0, '导航设置访问', NULL, 'N;'),
('menuList', 0, '导航设置列表', NULL, 'N;'),
('menuCreat', 0, '导航设置创建', NULL, 'N;'),
('menuEdit', 0, '导航设置编辑', NULL, 'N;'),
('menuAudit', 0, '导航设置审核', NULL, 'N;'),
('menuAuditAll', 0, '导航设置批量审核', NULL, 'N;'),
('menuUnAuditAll', 0, '导航设置批量不审核', NULL, 'N;'),
('menuHot', 0, '导航设置置热', NULL, 'N;'),
('menuRecommend', 0, '导航设置推荐', NULL, 'N;'),
('menuMoveUp', 0, '导航设置排序上移', NULL, 'N;'),
('menuMoveDown', 0, '导航设置排序下移', NULL, 'N;'),
('menuDelete', 0, '导航设置删除', NULL, 'N;'),
('menuDeleteAll', 0, '导航设置批量删除', NULL, 'N;'),
('newsIndex', 0, '导航文章访问', NULL, 'N;'),
('newsList', 0, '导航文章列表', NULL, 'N;'),
('newsCreat', 0, '导航文章创建', NULL, 'N;'),
('newsEdit', 0, '导航文章编辑', NULL, 'N;'),
('newsAudit', 0, '导航文章审核', NULL, 'N;'),
('newsAuditAll', 0, '导航文章批量审核', NULL, 'N;'),
('newsUnAuditAll', 0, '导航文章批量不审核', NULL, 'N;'),
('newsHot', 0, '导航文章置热', NULL, 'N;'),
('newsRecommend', 0, '导航文章推荐', NULL, 'N;'),
('newsMoveUp', 0, '导航文章排序上移', NULL, 'N;'),
('newsMoveDown', 0, '导航文章排序下移', NULL, 'N;'),
('newsDelete', 0, '导航文章删除', NULL, 'N;'),
('newsDeleteAll', 0, '导航文章批量删除', NULL, 'N;'),
('news_commentIndex', 0, '文章评论访问', NULL, 'N;'),
('news_commentList', 0, '文章评论列表', NULL, 'N;'),
('news_commentEdit', 0, '文章评论编辑', NULL, 'N;'),
('news_commentAudit', 0, '文章评论审核', NULL, 'N;'),
('news_commentAuditAll', 0, '文章评论批量审核', NULL, 'N;'),
('news_commentUnAuditAll', 0, '文章评论批量不审核', NULL, 'N;'),
('news_commentHot', 0, '文章评论置热', NULL, 'N;'),
('news_commentRecommend', 0, '文章评论推荐', NULL, 'N;'),
('news_commentMoveUp', 0, '文章评论排序上移', NULL, 'N;'),
('news_commentMoveDown', 0, '文章评论排序下移', NULL, 'N;'),
('news_commentDelete', 0, '文章评论删除', NULL, 'N;'),
('news_commentDeleteAll', 0, '文章评论批量删除', NULL, 'N;'),
('leafIndex', 0, '单页管理访问', NULL, 'N;'),
('leafList', 0, '单页管理列表', NULL, 'N;'),
('leafCreat', 0, '单页管理创建', NULL, 'N;'),
('leafEdit', 0, '单页管理编辑', NULL, 'N;'),
('leafAudit', 0, '单页管理审核', NULL, 'N;'),
('leafAuditAll', 0, '单页管理批量审核', NULL, 'N;'),
('leafUnAuditAll', 0, '单页管理批量不审核', NULL, 'N;'),
('leafHot', 0, '单页管理置热', NULL, 'N;'),
('leafRecommend', 0, '单页管理推荐', NULL, 'N;'),
('leafMoveUp', 0, '单页管理排序上移', NULL, 'N;'),
('leafMoveDown', 0, '单页管理排序下移', NULL, 'N;'),
('leafDelete', 0, '单页管理删除', NULL, 'N;'),
('leafDeleteAll', 0, '单页管理批量删除', NULL, 'N;'),
('articleIndex', 0, '单页文章访问', NULL, 'N;'),
('articleList', 0, '单页文章列表', NULL, 'N;'),
('articleCreat', 0, '单页文章创建', NULL, 'N;'),
('articleEdit', 0, '单页文章编辑', NULL, 'N;'),
('articleAudit', 0, '单页文章审核', NULL, 'N;'),
('articleAuditAll', 0, '单页文章批量审核', NULL, 'N;'),
('articleUnAuditAll', 0, '单页文章批量不审核', NULL, 'N;'),
('articleHot', 0, '单页文章置热', NULL, 'N;'),
('articleRecommend', 0, '单页文章推荐', NULL, 'N;'),
('articleMoveUp', 0, '单页文章排序上移', NULL, 'N;'),
('articleMoveDown', 0, '单页文章排序下移', NULL, 'N;'),
('articleDelete', 0, '单页文章删除', NULL, 'N;'),
('articleDeleteAll', 0, '单页文章批量删除', NULL, 'N;'),
('categoryIndex', 0, '产品分类访问', NULL, 'N;'),
('categoryList', 0, '产品分类列表', NULL, 'N;'),
('categoryCreat', 0, '产品分类创建', NULL, 'N;'),
('categoryEdit', 0, '产品分类编辑', NULL, 'N;'),
('categoryAudit', 0, '产品分类审核', NULL, 'N;'),
('categoryAuditAll', 0, '产品分类批量审核', NULL, 'N;'),
('categoryUnAuditAll', 0, '产品分类批量不审核', NULL, 'N;'),
('categoryHot', 0, '产品分类置热', NULL, 'N;'),
('categoryRecommend', 0, '产品分类推荐', NULL, 'N;'),
('categoryMoveUp', 0, '产品分类排序上移', NULL, 'N;'),
('categoryMoveDown', 0, '产品分类排序下移', NULL, 'N;'),
('categoryDelete', 0, '产品分类删除', NULL, 'N;'),
('categoryDeleteAll', 0, '产品分类批量删除', NULL, 'N;'),
('productIndex', 0, '产品管理访问', NULL, 'N;'),
('productList', 0, '产品管理列表', NULL, 'N;'),
('productCreat', 0, '产品管理创建', NULL, 'N;'),
('productEdit', 0, '产品管理编辑', NULL, 'N;'),
('productAudit', 0, '产品管理审核', NULL, 'N;'),
('productAuditAll', 0, '产品管理批量审核', NULL, 'N;'),
('productUnAuditAll', 0, '产品管理批量不审核', NULL, 'N;'),
('productHot', 0, '产品管理置热', NULL, 'N;'),
('productRecommend', 0, '产品管理推荐', NULL, 'N;'),
('productMoveUp', 0, '产品管理排序上移', NULL, 'N;'),
('productMoveDown', 0, '产品管理排序下移', NULL, 'N;'),
('productDelete', 0, '产品管理删除', NULL, 'N;'),
('productDeleteAll', 0, '产品管理批量删除', NULL, 'N;'),
('product_commentIndex', 0, '产品评论访问', NULL, 'N;'),
('product_commentList', 0, '产品评论列表', NULL, 'N;'),
('product_commentCreat', 0, '产品评论创建', NULL, 'N;'),
('product_commentEdit', 0, '产品评论编辑', NULL, 'N;'),
('product_commentAudit', 0, '产品评论审核', NULL, 'N;'),
('product_commentAuditAll', 0, '产品评论批量审核', NULL, 'N;'),
('product_commentUnAuditAll', 0, '产品评论批量不审核', NULL, 'N;'),
('product_commentHot', 0, '产品评论置热', NULL, 'N;'),
('product_commentRecommend', 0, '产品评论推荐', NULL, 'N;'),
('product_commentMoveUp', 0, '产品评论排序上移', NULL, 'N;'),
('product_commentMoveDown', 0, '产品评论排序下移', NULL, 'N;'),
('product_commentDelete', 0, '产品评论删除', NULL, 'N;'),
('product_commentDeleteAll', 0, '产品评论批量删除', NULL, 'N;'),
('typeIndex', 0, '图片分类访问', NULL, 'N;'),
('typeList', 0, '图片分类列表', NULL, 'N;'),
('typeCreat', 0, '图片分类创建', NULL, 'N;'),
('typeEdit', 0, '图片分类编辑', NULL, 'N;'),
('typeAudit', 0, '图片分类审核', NULL, 'N;'),
('typeAuditAll', 0, '图片分类批量审核', NULL, 'N;'),
('typeUnAuditAll', 0, '图片分类批量不审核', NULL, 'N;'),
('typeHot', 0, '图片分类置热', NULL, 'N;'),
('typeRecommend', 0, '图片分类推荐', NULL, 'N;'),
('typeMoveUp', 0, '图片分类排序上移', NULL, 'N;'),
('typeMoveDown', 0, '图片分类排序下移', NULL, 'N;'),
('typeDelete', 0, '图片分类删除', NULL, 'N;'),
('typeDeleteAll', 0, '图片分类批量删除', NULL, 'N;'),
('pictureIndex', 0, '图片管理访问', NULL, 'N;'),
('pictureList', 0, '图片管理列表', NULL, 'N;'),
('pictureCreat', 0, '图片管理创建', NULL, 'N;'),
('pictureEdit', 0, '图片管理编辑', NULL, 'N;'),
('pictureAudit', 0, '图片管理审核', NULL, 'N;'),
('pictureAuditAll', 0, '图片管理批量审核', NULL, 'N;'),
('pictureUnAuditAll', 0, '图片管理批量不审核', NULL, 'N;'),
('pictureHot', 0, '图片管理置热', NULL, 'N;'),
('pictureRecommend', 0, '图片管理推荐', NULL, 'N;'),
('pictureMoveUp', 0, '图片管理排序上移', NULL, 'N;'),
('pictureMoveDown', 0, '图片管理排序下移', NULL, 'N;'),
('pictureDelete', 0, '图片管理删除', NULL, 'N;'),
('pictureDeleteAll', 0, '图片管理批量删除', NULL, 'N;'),
('activityIndex', 0, '活动管理访问', NULL, 'N;'),
('activityList', 0, '活动管理列表', NULL, 'N;'),
('activityCreat', 0, '活动管理创建', NULL, 'N;'),
('activityEdit', 0, '活动管理编辑', NULL, 'N;'),
('activityAudit', 0, '活动管理审核', NULL, 'N;'),
('activityAuditAll', 0, '活动管理批量审核', NULL, 'N;'),
('activityUnAuditAll', 0, '活动管理批量不审核', NULL, 'N;'),
('activityHot', 0, '活动管理置热', NULL, 'N;'),
('activityRecommend', 0, '活动管理推荐', NULL, 'N;'),
('activityMoveUp', 0, '活动管理排序上移', NULL, 'N;'),
('activityMoveDown', 0, '活动管理排序下移', NULL, 'N;'),
('activityDelete', 0, '活动管理删除', NULL, 'N;'),
('activityDeleteAll', 0, '活动管理批量删除', NULL, 'N;'),
('topicIndex', 0, '专题管理访问', NULL, 'N;'),
('topicList', 0, '专题管理列表', NULL, 'N;'),
('topicCreat', 0, '专题管理创建', NULL, 'N;'),
('topicEdit', 0, '专题管理编辑', NULL, 'N;'),
('topicAudit', 0, '专题管理审核', NULL, 'N;'),
('topicAuditAll', 0, '专题管理批量审核', NULL, 'N;'),
('topicUnAuditAll', 0, '专题管理批量不审核', NULL, 'N;'),
('topicHot', 0, '专题管理置热', NULL, 'N;'),
('topicRecommend', 0, '专题管理推荐', NULL, 'N;'),
('topicMoveUp', 0, '专题管理排序上移', NULL, 'N;'),
('topicMoveDown', 0, '专题管理排序下移', NULL, 'N;'),
('topicDelete', 0, '专题管理删除', NULL, 'N;'),
('topicDeleteAll', 0, '专题管理批量删除', NULL, 'N;'),
('voteIndex', 0, '投票管理访问', NULL, 'N;'),
('voteList', 0, '投票管理列表', NULL, 'N;'),
('voteCreat', 0, '投票管理创建', NULL, 'N;'),
('voteEdit', 0, '投票管理编辑', NULL, 'N;'),
('voteAudit', 0, '投票管理审核', NULL, 'N;'),
('voteAuditAll', 0, '投票管理批量审核', NULL, 'N;'),
('voteUnAuditAll', 0, '投票管理批量不审核', NULL, 'N;'),
('voteHot', 0, '投票管理置热', NULL, 'N;'),
('voteRecommend', 0, '投票管理推荐', NULL, 'N;'),
('voteMoveUp', 0, '投票管理排序上移', NULL, 'N;'),
('voteMoveDown', 0, '投票管理排序下移', NULL, 'N;'),
('voteDelete', 0, '投票管理删除', NULL, 'N;'),
('voteDeleteAll', 0, '投票管理批量删除', NULL, 'N;'),
('friend_linkIndex', 0, '友情链接访问', NULL, 'N;'),
('friend_linkList', 0, '友情链接列表', NULL, 'N;'),
('friend_linkCreat', 0, '友情链接创建', NULL, 'N;'),
('friend_linkEdit', 0, '友情链接编辑', NULL, 'N;'),
('friend_linkAudit', 0, '友情链接审核', NULL, 'N;'),
('friend_linkAuditAll', 0, '友情链接批量审核', NULL, 'N;'),
('friend_linkUnAuditAll', 0, '友情链接批量不审核', NULL, 'N;'),
('friend_linkHot', 0, '友情链接置热', NULL, 'N;'),
('friend_linkRecommend', 0, '友情链接推荐', NULL, 'N;'),
('friend_linkMoveUp', 0, '友情链接排序上移', NULL, 'N;'),
('friend_linkMoveDown', 0, '友情链接排序下移', NULL, 'N;'),
('friend_linkDelete', 0, '友情链接删除', NULL, 'N;'),
('friend_linkDeleteAll', 0, '友情链接批量删除', NULL, 'N;'),
('advertisementIndex', 0, '广告管理访问', NULL, 'N;'),
('advertisementList', 0, '广告管理列表', NULL, 'N;'),
('advertisementCreat', 0, '广告管理创建', NULL, 'N;'),
('advertisementEdit', 0, '广告管理编辑', NULL, 'N;'),
('advertisementAudit', 0, '广告管理审核', NULL, 'N;'),
('advertisementAuditAll', 0, '广告管理批量审核', NULL, 'N;'),
('advertisementUnAuditAll', 0, '广告管理批量不审核', NULL, 'N;'),
('advertisementHot', 0, '广告管理置热', NULL, 'N;'),
('advertisementRecommend', 0, '广告管理推荐', NULL, 'N;'),
('advertisementMoveUp', 0, '广告管理排序上移', NULL, 'N;'),
('advertisementMoveDown', 0, '广告管理排序下移', NULL, 'N;'),
('advertisementDelete', 0, '广告管理删除', NULL, 'N;'),
('advertisementDeleteAll', 0, '广告管理批量删除', NULL, 'N;'),
('advertisingIndex', 0, '广 告 位访问', NULL, 'N;'),
('advertisingList', 0, '广 告 位列表', NULL, 'N;'),
('advertisingCreat', 0, '广 告 位创建', NULL, 'N;'),
('advertisingEdit', 0, '广 告 位编辑', NULL, 'N;'),
('advertisingAudit', 0, '广 告 位审核', NULL, 'N;'),
('advertisingAuditAll', 0, '广 告 位批量审核', NULL, 'N;'),
('advertisingUnAuditAll', 0, '广 告 位批量不审核', NULL, 'N;'),
('advertisingHot', 0, '广 告 位置热', NULL, 'N;'),
('advertisingRecommend', 0, '广 告 位推荐', NULL, 'N;'),
('advertisingMoveUp', 0, '广 告 位排序上移', NULL, 'N;'),
('advertisingMoveDown', 0, '广 告 位排序下移', NULL, 'N;'),
('advertisingDelete', 0, '广 告 位删除', NULL, 'N;'),
('advertisingDeleteAll', 0, '广 告 位批量删除', NULL, 'N;');

-- --------------------------------------------------------

--
-- 表的结构 `v_auth_item_children`
--

CREATE TABLE IF NOT EXISTS `v_auth_item_children` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `v_auth_item_children`
--

INSERT INTO `v_auth_item_children` (`parent`, `child`) VALUES
('超级管理员', 'activityAudit'),
('超级管理员', 'activityAuditAll'),
('超级管理员', 'activityCreat'),
('超级管理员', 'activityDelete'),
('超级管理员', 'activityDeleteAll'),
('超级管理员', 'activityEdit'),
('超级管理员', 'activityHot'),
('超级管理员', 'activityIndex'),
('超级管理员', 'activityList'),
('超级管理员', 'activityMoveDown'),
('超级管理员', 'activityMoveUp'),
('超级管理员', 'activityRecommend'),
('超级管理员', 'activityUnAuditAll'),
('超级管理员', 'adminAudit'),
('超级管理员', 'adminAuditAll'),
('超级管理员', 'adminCreat'),
('超级管理员', 'adminDelete'),
('超级管理员', 'adminDeleteAll'),
('超级管理员', 'adminEdit'),
('超级管理员', 'adminHot'),
('超级管理员', 'adminIndex'),
('超级管理员', 'adminList'),
('超级管理员', 'adminMoveDown'),
('超级管理员', 'adminMoveUp'),
('超级管理员', 'adminRecommend'),
('超级管理员', 'adminUnAuditAll'),
('超级管理员', 'advertisementAudit'),
('超级管理员', 'advertisementAuditAll'),
('超级管理员', 'advertisementCreat'),
('超级管理员', 'advertisementDelete'),
('超级管理员', 'advertisementDeleteAll'),
('超级管理员', 'advertisementEdit'),
('超级管理员', 'advertisementHot'),
('超级管理员', 'advertisementIndex'),
('超级管理员', 'advertisementList'),
('超级管理员', 'advertisementMoveDown'),
('超级管理员', 'advertisementMoveUp'),
('超级管理员', 'advertisementRecommend'),
('超级管理员', 'advertisementUnAuditAll'),
('超级管理员', 'advertisingAudit'),
('超级管理员', 'advertisingAuditAll'),
('超级管理员', 'advertisingCreat'),
('超级管理员', 'advertisingDelete'),
('超级管理员', 'advertisingDeleteAll'),
('超级管理员', 'advertisingEdit'),
('超级管理员', 'advertisingHot'),
('超级管理员', 'advertisingIndex'),
('超级管理员', 'advertisingList'),
('超级管理员', 'advertisingMoveDown'),
('超级管理员', 'advertisingMoveUp'),
('超级管理员', 'advertisingRecommend'),
('超级管理员', 'advertisingUnAuditAll'),
('超级管理员', 'articleAudit'),
('超级管理员', 'articleAuditAll'),
('超级管理员', 'articleCreat'),
('超级管理员', 'articleDelete'),
('超级管理员', 'articleDeleteAll'),
('超级管理员', 'articleEdit'),
('超级管理员', 'articleHot'),
('超级管理员', 'articleIndex'),
('超级管理员', 'articleList'),
('超级管理员', 'articleMoveDown'),
('超级管理员', 'articleMoveUp'),
('超级管理员', 'articleRecommend'),
('超级管理员', 'articleUnAuditAll'),
('超级管理员', 'authorityAudit'),
('超级管理员', 'authorityAuditAll'),
('超级管理员', 'authorityEdit'),
('超级管理员', 'authorityHot'),
('超级管理员', 'authorityIndex'),
('超级管理员', 'authorityList'),
('超级管理员', 'authorityMoveDown'),
('超级管理员', 'authorityMoveUp'),
('超级管理员', 'authorityRecommend'),
('超级管理员', 'authorityUnAuditAll'),
('超级管理员', 'categoryAudit'),
('超级管理员', 'categoryAuditAll'),
('超级管理员', 'categoryCreat'),
('超级管理员', 'categoryDelete'),
('超级管理员', 'categoryDeleteAll'),
('超级管理员', 'categoryEdit'),
('超级管理员', 'categoryHot'),
('超级管理员', 'categoryIndex'),
('超级管理员', 'categoryList'),
('超级管理员', 'categoryMoveDown'),
('超级管理员', 'categoryMoveUp'),
('超级管理员', 'categoryRecommend'),
('超级管理员', 'categoryUnAuditAll'),
('超级管理员', 'databaseAudit'),
('超级管理员', 'databaseAuditAll'),
('超级管理员', 'databaseEdit'),
('超级管理员', 'databaseHot'),
('超级管理员', 'databaseIndex'),
('超级管理员', 'databaseList'),
('超级管理员', 'databaseMoveDown'),
('超级管理员', 'databaseMoveUp'),
('超级管理员', 'databaseRecommend'),
('超级管理员', 'databaseUnAuditAll'),
('超级管理员', 'friend_linkAudit'),
('超级管理员', 'friend_linkAuditAll'),
('超级管理员', 'friend_linkCreat'),
('超级管理员', 'friend_linkDelete'),
('超级管理员', 'friend_linkDeleteAll'),
('超级管理员', 'friend_linkEdit'),
('超级管理员', 'friend_linkHot'),
('超级管理员', 'friend_linkIndex'),
('超级管理员', 'friend_linkList'),
('超级管理员', 'friend_linkMoveDown'),
('超级管理员', 'friend_linkMoveUp'),
('超级管理员', 'friend_linkRecommend'),
('超级管理员', 'friend_linkUnAuditAll'),
('超级管理员', 'leafAudit'),
('超级管理员', 'leafAuditAll'),
('超级管理员', 'leafCreat'),
('超级管理员', 'leafDelete'),
('超级管理员', 'leafDeleteAll'),
('超级管理员', 'leafEdit'),
('超级管理员', 'leafHot'),
('超级管理员', 'leafIndex'),
('超级管理员', 'leafList'),
('超级管理员', 'leafMoveDown'),
('超级管理员', 'leafMoveUp'),
('超级管理员', 'leafRecommend'),
('超级管理员', 'leafUnAuditAll'),
('超级管理员', 'masterAudit'),
('超级管理员', 'masterAuditAll'),
('超级管理员', 'masterEdit'),
('超级管理员', 'masterHot'),
('超级管理员', 'masterIndex'),
('超级管理员', 'masterList'),
('超级管理员', 'masterMoveDown'),
('超级管理员', 'masterMoveUp'),
('超级管理员', 'masterRecommend'),
('超级管理员', 'masterUnAuditAll'),
('超级管理员', 'memberAudit'),
('超级管理员', 'memberAuditAll'),
('超级管理员', 'memberCreat'),
('超级管理员', 'memberDelete'),
('超级管理员', 'memberDeleteAll'),
('超级管理员', 'memberEdit'),
('超级管理员', 'memberHot'),
('超级管理员', 'memberIndex'),
('超级管理员', 'memberList'),
('超级管理员', 'memberMoveDown'),
('超级管理员', 'memberMoveUp'),
('超级管理员', 'memberRecommend'),
('超级管理员', 'memberUnAuditAll'),
('超级管理员', 'menuAudit'),
('超级管理员', 'menuAuditAll'),
('超级管理员', 'menuCreat'),
('超级管理员', 'menuDelete'),
('超级管理员', 'menuDeleteAll'),
('超级管理员', 'menuEdit'),
('超级管理员', 'menuHot'),
('超级管理员', 'menuIndex'),
('超级管理员', 'menuList'),
('超级管理员', 'menuMoveDown'),
('超级管理员', 'menuMoveUp'),
('超级管理员', 'menuRecommend'),
('超级管理员', 'menuUnAuditAll'),
('超级管理员', 'newsAudit'),
('超级管理员', 'newsAuditAll'),
('超级管理员', 'newsCreat'),
('超级管理员', 'newsDelete'),
('超级管理员', 'newsDeleteAll'),
('超级管理员', 'newsEdit'),
('超级管理员', 'newsHot'),
('超级管理员', 'newsIndex'),
('超级管理员', 'newsList'),
('超级管理员', 'newsMoveDown'),
('超级管理员', 'newsMoveUp'),
('超级管理员', 'newsRecommend'),
('超级管理员', 'newsUnAuditAll'),
('超级管理员', 'news_commentAudit'),
('超级管理员', 'news_commentAuditAll'),
('超级管理员', 'news_commentDelete'),
('超级管理员', 'news_commentDeleteAll'),
('超级管理员', 'news_commentEdit'),
('超级管理员', 'news_commentHot'),
('超级管理员', 'news_commentIndex'),
('超级管理员', 'news_commentList'),
('超级管理员', 'news_commentMoveDown'),
('超级管理员', 'news_commentMoveUp'),
('超级管理员', 'news_commentRecommend'),
('超级管理员', 'news_commentUnAuditAll'),
('超级管理员', 'pictureAudit'),
('超级管理员', 'pictureAuditAll'),
('超级管理员', 'pictureCreat'),
('超级管理员', 'pictureDelete'),
('超级管理员', 'pictureDeleteAll'),
('超级管理员', 'pictureEdit'),
('超级管理员', 'pictureHot'),
('超级管理员', 'pictureIndex'),
('超级管理员', 'pictureList'),
('超级管理员', 'pictureMoveDown'),
('超级管理员', 'pictureMoveUp'),
('超级管理员', 'pictureRecommend'),
('超级管理员', 'pictureUnAuditAll'),
('超级管理员', 'productAudit'),
('超级管理员', 'productAuditAll'),
('超级管理员', 'productCreat'),
('超级管理员', 'productDelete'),
('超级管理员', 'productDeleteAll'),
('超级管理员', 'productEdit'),
('超级管理员', 'productHot'),
('超级管理员', 'productIndex'),
('超级管理员', 'productList'),
('超级管理员', 'productMoveDown'),
('超级管理员', 'productMoveUp'),
('超级管理员', 'productRecommend'),
('超级管理员', 'productUnAuditAll'),
('超级管理员', 'product_commentAudit'),
('超级管理员', 'product_commentAuditAll'),
('超级管理员', 'product_commentCreat'),
('超级管理员', 'product_commentDelete'),
('超级管理员', 'product_commentDeleteAll'),
('超级管理员', 'product_commentEdit'),
('超级管理员', 'product_commentHot'),
('超级管理员', 'product_commentIndex'),
('超级管理员', 'product_commentList'),
('超级管理员', 'product_commentMoveDown'),
('超级管理员', 'product_commentMoveUp'),
('超级管理员', 'product_commentRecommend'),
('超级管理员', 'product_commentUnAuditAll'),
('超级管理员', 'siteAudit'),
('超级管理员', 'siteAuditAll'),
('超级管理员', 'siteEdit'),
('超级管理员', 'siteHot'),
('超级管理员', 'siteIndex'),
('超级管理员', 'siteList'),
('超级管理员', 'siteMoveDown'),
('超级管理员', 'siteMoveUp'),
('超级管理员', 'siteRecommend'),
('超级管理员', 'siteUnAuditAll'),
('超级管理员', 'topicAudit'),
('超级管理员', 'topicAuditAll'),
('超级管理员', 'topicCreat'),
('超级管理员', 'topicDelete'),
('超级管理员', 'topicDeleteAll'),
('超级管理员', 'topicEdit'),
('超级管理员', 'topicHot'),
('超级管理员', 'topicIndex'),
('超级管理员', 'topicList'),
('超级管理员', 'topicMoveDown'),
('超级管理员', 'topicMoveUp'),
('超级管理员', 'topicRecommend'),
('超级管理员', 'topicUnAuditAll'),
('超级管理员', 'typeAudit'),
('超级管理员', 'typeAuditAll'),
('超级管理员', 'typeCreat'),
('超级管理员', 'typeDelete'),
('超级管理员', 'typeDeleteAll'),
('超级管理员', 'typeEdit'),
('超级管理员', 'typeHot'),
('超级管理员', 'typeIndex'),
('超级管理员', 'typeList'),
('超级管理员', 'typeMoveDown'),
('超级管理员', 'typeMoveUp'),
('超级管理员', 'typeRecommend'),
('超级管理员', 'typeUnAuditAll'),
('超级管理员', 'voteAudit'),
('超级管理员', 'voteAuditAll'),
('超级管理员', 'voteCreat'),
('超级管理员', 'voteDelete'),
('超级管理员', 'voteDeleteAll'),
('超级管理员', 'voteEdit'),
('超级管理员', 'voteHot'),
('超级管理员', 'voteIndex'),
('超级管理员', 'voteList'),
('超级管理员', 'voteMoveDown'),
('超级管理员', 'voteMoveUp'),
('超级管理员', 'voteRecommend'),
('超级管理员', 'voteUnAuditAll');

-- --------------------------------------------------------

--
-- 表的结构 `v_category`
--

CREATE TABLE IF NOT EXISTS `v_category` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `component` varchar(50) DEFAULT NULL,
  `lft` int(10) NOT NULL DEFAULT '0',
  `rgt` int(10) NOT NULL DEFAULT '0',
  `parent` int(10) NOT NULL DEFAULT '0',
  `depth` int(10) DEFAULT '1',
  `content` text,
  `audit` int(1) DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `update_time` int(15) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `lft` (`lft`,`rgt`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `v_category`
--

INSERT INTO `v_category` (`id`, `name`, `component`, `lft`, `rgt`, `parent`, `depth`, `content`, `audit`, `title`, `description`, `keyword`, `update_time`) VALUES
(1, '服装', NULL, 1, 6, 0, 1, NULL, 1, NULL, NULL, NULL, 1389081316),
(2, '电器', NULL, 7, 12, 0, 1, NULL, 1, NULL, NULL, NULL, 1389081331),
(3, '上衣', NULL, 2, 3, 1, 2, NULL, 1, NULL, NULL, NULL, 1389081380),
(4, '裙子', NULL, 4, 5, 1, 2, NULL, 1, NULL, NULL, NULL, 1389081392),
(5, '笔记本', NULL, 8, 9, 2, 2, NULL, 1, NULL, NULL, NULL, 1389081407),
(6, '洗衣机', NULL, 10, 11, 2, 2, NULL, 1, NULL, NULL, NULL, 1389081426);

-- --------------------------------------------------------

--
-- 表的结构 `v_friend_link`
--

CREATE TABLE IF NOT EXISTS `v_friend_link` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `link` varchar(150) DEFAULT NULL,
  `menu` int(10) DEFAULT '1',
  `photo1` varchar(100) DEFAULT NULL,
  `webmaster` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `content` text,
  `audit` int(1) DEFAULT '0',
  `create_date` int(15) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `v_friend_link`
--

INSERT INTO `v_friend_link` (`id`, `name`, `link`, `menu`, `photo1`, `webmaster`, `email`, `content`, `audit`, `create_date`) VALUES
(1, '旅游在线网', 'http://www.travel-cn.net/', 0, NULL, '', '', '', 1, 1329632690),
(2, '湖南旅游网', 'http://www.51766hn.com/', 1, NULL, '', '', '', 1, 1320583344),
(3, '重庆中国国际旅行社', 'http://www.023huifeng.com/ ', 1, NULL, '', '', '', 0, 1320583336),
(4, '四川青旅', 'http://www.tfyou.com/', 1, NULL, '', '', '四川青旅', 0, 1320583374),
(5, '云南旅游景点地图', 'http://www.zuimeiyunnan.com/', 1, NULL, '', '', '云南旅游景点地图', 0, 1348149162),
(6, '香港美丽假期', 'http://www.hklvtu.com/', 1, NULL, '', '', '', 1, 1348507889),
(7, '宜昌旅游网', 'http://www.517zj.com.cn/', 1, NULL, '', '', '宜昌旅游网', 0, 1348567487),
(8, '西双版纳旅游', 'http://www.qxsbnly.com/', 1, NULL, '', '', '西双版纳旅游', 1, 1348567621),
(9, '南宁旅行社', 'http://www.0771u.com/', 1, NULL, '', '', '南宁旅行社', 0, 1349863484),
(10, '云南旅游', 'http://www.yyn8.com/', 1, NULL, '', '', '云南旅游', 0, 1350122359),
(11, '丽江旅游', 'http://www.ljly.cn/', 1, NULL, '', '', '丽江旅游', 0, 1350293179),
(12, '景程旅行网', 'http://www.iepica.com/', 1, NULL, '', '', '景程旅行网', 0, 1351265744),
(13, '深圳旅游公司', 'http://www.lttoo.com/', 1, NULL, '', '', '深圳旅游公司', 1, 1351763845),
(14, '南京旅行社', 'http://www.njtrip.com/', 1, NULL, '', '', '南京旅行社', 1, 1352721190);

-- --------------------------------------------------------

--
-- 表的结构 `v_leaf`
--

CREATE TABLE IF NOT EXISTS `v_leaf` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `component` varchar(50) DEFAULT NULL,
  `lft` int(10) NOT NULL DEFAULT '0',
  `rgt` int(10) NOT NULL DEFAULT '0',
  `parent` int(10) NOT NULL DEFAULT '0',
  `depth` int(10) DEFAULT '1',
  `content` text,
  `audit` int(1) DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `update_time` int(15) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `lft` (`lft`,`rgt`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `v_leaf`
--

INSERT INTO `v_leaf` (`id`, `name`, `component`, `lft`, `rgt`, `parent`, `depth`, `content`, `audit`, `title`, `description`, `keyword`, `update_time`) VALUES
(1, '关于我们', 'about', 1, 6, 0, 1, NULL, 1, NULL, NULL, NULL, 1380273779),
(2, '联系我们', 'contact', 7, 8, 0, 1, NULL, 1, NULL, NULL, NULL, 1380273796),
(3, '公司简介', 'company', 2, 3, 1, 2, NULL, 1, NULL, NULL, NULL, 1380273824),
(4, '大事记', 'note', 4, 5, 1, 2, NULL, 1, NULL, NULL, NULL, 1380273840);

-- --------------------------------------------------------

--
-- 表的结构 `v_master`
--

CREATE TABLE IF NOT EXISTS `v_master` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `organization` varchar(100) DEFAULT NULL,
  `master` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `postcode` varchar(10) DEFAULT NULL,
  `update_time` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `v_master`
--

INSERT INTO `v_master` (`id`, `organization`, `master`, `phone`, `fax`, `email`, `address`, `postcode`, `update_time`) VALUES
(1, '北京', '熊进超', '15814449927', NULL, 'mteddy@126.com', '深圳市坂田区马蹄山村三巷10号606', '518000', 1381399329);

-- --------------------------------------------------------

--
-- 表的结构 `v_member`
--

CREATE TABLE IF NOT EXISTS `v_member` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(80) DEFAULT NULL,
  `audit` int(1) DEFAULT '1',
  `name` varchar(40) DEFAULT NULL,
  `gender` int(1) DEFAULT '0',
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `qq` varchar(20) DEFAULT NULL,
  `photo1` varchar(120) DEFAULT NULL,
  `last_login_time` int(15) NOT NULL DEFAULT '0',
  `last_logout_time` int(15) NOT NULL DEFAULT '0',
  `login_times` int(10) DEFAULT '0',
  `create_time` int(15) NOT NULL DEFAULT '0',
  `update_time` int(15) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `v_member`
--

INSERT INTO `v_member` (`id`, `username`, `password`, `audit`, `name`, `gender`, `phone`, `email`, `qq`, `photo1`, `last_login_time`, `last_logout_time`, `login_times`, `create_time`, `update_time`) VALUES
(1, 'QQlvyou', 'e10adc3949ba59abbe56e057f20f883e', 1, '熊进超', 0, '15814449927', 'Mteddy@126.com', NULL, '/upload/image/member/201401/20140115102520_93718.jpg', 0, 0, 0, 1389781485, 1389837483),
(2, 'Teddy', 'e10adc3949ba59abbe56e057f20f883e', 1, '熊进超', 0, '13311002524', '380448100@qq.com', NULL, NULL, 0, 0, 0, 1389837785, 1389838067);

-- --------------------------------------------------------

--
-- 表的结构 `v_menu`
--

CREATE TABLE IF NOT EXISTS `v_menu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `component` varchar(50) DEFAULT NULL,
  `lft` int(10) NOT NULL DEFAULT '0',
  `rgt` int(10) NOT NULL DEFAULT '0',
  `parent` int(10) NOT NULL DEFAULT '0',
  `depth` int(10) DEFAULT '1',
  `content` text,
  `audit` int(1) DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `update_time` int(15) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `lft` (`lft`,`rgt`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `v_menu`
--

INSERT INTO `v_menu` (`id`, `name`, `component`, `lft`, `rgt`, `parent`, `depth`, `content`, `audit`, `title`, `description`, `keyword`, `update_time`) VALUES
(1, '首页', 'home', 1, 2, 0, 1, NULL, 1, NULL, NULL, NULL, 1389838162),
(2, '关于我们', 'about_us', 3, 8, 0, 1, NULL, 1, NULL, NULL, NULL, 1389838196),
(3, '组织简介', NULL, 4, 5, 2, 2, NULL, 1, NULL, NULL, NULL, 1389838231),
(4, '组织架构', NULL, 6, 7, 2, 2, NULL, 1, NULL, NULL, NULL, 1389838243),
(5, '产品展示', 'product', 9, 10, 0, 1, NULL, 1, NULL, NULL, NULL, 1389838278),
(6, '联系我们', 'contact_us', 17, 18, 0, 1, NULL, 1, NULL, NULL, NULL, 1389838288),
(7, '新闻中心', 'news', 11, 16, 0, 1, NULL, 1, NULL, NULL, NULL, 1389839554),
(8, '国内新闻', NULL, 12, 13, 7, 2, NULL, 1, NULL, NULL, NULL, 1389838335),
(9, '国外新闻', NULL, 14, 15, 7, 2, NULL, 1, NULL, NULL, NULL, 1389838358);

-- --------------------------------------------------------

--
-- 表的结构 `v_news`
--

CREATE TABLE IF NOT EXISTS `v_news` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `menu_id` int(10) DEFAULT NULL,
  `content` text,
  `audit` int(11) DEFAULT '0',
  `hot` int(1) DEFAULT '0',
  `recommend` int(1) DEFAULT '0',
  `photo1` varchar(120) NOT NULL,
  `photo2` varchar(120) NOT NULL,
  `hit` int(10) DEFAULT '0',
  `comment_number` int(10) NOT NULL DEFAULT '0',
  `source` varchar(100) DEFAULT NULL,
  `source_url` varchar(120) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `create_time` int(10) NOT NULL DEFAULT '0',
  `update_time` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `v_news`
--

INSERT INTO `v_news` (`id`, `title`, `menu_id`, `content`, `audit`, `hot`, `recommend`, `photo1`, `photo2`, `hit`, `comment_number`, `source`, `source_url`, `description`, `keyword`, `create_time`, `update_time`) VALUES
(1, '我和丽江有个约会', 8, NULL, 1, 0, 1, '/upload/image/news/201311/20131106075415_90779.jpg', '/upload/image/news/201311/20131106025439_75291.jpg', 1, 1, NULL, NULL, NULL, NULL, 1381464101, 1389838376);

-- --------------------------------------------------------

--
-- 表的结构 `v_news_comment`
--

CREATE TABLE IF NOT EXISTS `v_news_comment` (
  `id` int(10) NOT NULL,
  `news_id` int(10) NOT NULL,
  `member_id` int(10) NOT NULL,
  `content` text NOT NULL,
  `audit` int(1) NOT NULL DEFAULT '0',
  `hot` int(1) NOT NULL DEFAULT '0',
  `create_time` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `v_news_comment`
--

INSERT INTO `v_news_comment` (`id`, `news_id`, `member_id`, `content`, `audit`, `hot`, `create_time`) VALUES
(1, 1, 1, '“将军府”不过是一幅非常老套的升官发财图。这个故事当中，有“一人得道，鸡犬升天”，也有家人有恃无恐、横行乡里。', 1, 1, 1389838067);

-- --------------------------------------------------------

--
-- 表的结构 `v_picture`
--

CREATE TABLE IF NOT EXISTS `v_picture` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `type_id` int(10) DEFAULT NULL,
  `content` text,
  `audit` int(11) DEFAULT '0',
  `hot` int(1) DEFAULT '0',
  `recommend` int(1) DEFAULT '0',
  `photo1` varchar(120) NOT NULL,
  `photo2` varchar(120) NOT NULL,
  `hit` int(10) DEFAULT '0',
  `description` varchar(255) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `create_time` int(10) NOT NULL DEFAULT '0',
  `update_time` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `v_picture`
--

INSERT INTO `v_picture` (`id`, `title`, `type_id`, `content`, `audit`, `hot`, `recommend`, `photo1`, `photo2`, `hit`, `description`, `keyword`, `create_time`, `update_time`) VALUES
(1, '冲锋衣', 3, NULL, 1, 1, 1, '/upload/image/picture/201401/20140115102220_51638.jpg', '/upload/image/picture/201401/20140115093706_48246.jpg', 0, NULL, NULL, 1382326986, 1389781340);

-- --------------------------------------------------------

--
-- 表的结构 `v_product`
--

CREATE TABLE IF NOT EXISTS `v_product` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `category_id` int(10) DEFAULT NULL,
  `content` text,
  `audit` int(11) DEFAULT '0',
  `hot` int(1) DEFAULT '0',
  `recommend` int(1) DEFAULT '0',
  `photo1` varchar(120) NOT NULL,
  `photo2` varchar(120) NOT NULL,
  `hit` int(10) DEFAULT '0',
  `star` int(1) NOT NULL DEFAULT '0',
  `comment_number` int(10) NOT NULL DEFAULT '0',
  `market_price` decimal(10,2) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `create_time` int(10) NOT NULL DEFAULT '0',
  `update_time` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `v_product`
--

INSERT INTO `v_product` (`id`, `title`, `category_id`, `content`, `audit`, `hot`, `recommend`, `photo1`, `photo2`, `hit`, `star`, `comment_number`, `market_price`, `price`, `description`, `keyword`, `create_time`, `update_time`) VALUES
(1, '冲锋衣', 3, NULL, 1, 1, 1, '/upload/image/product/201401/20140115102130_14627.jpg', '/upload/image/product/201401/20140115102125_14427.jpg', 0, 2, 0, '120.00', '100.00', NULL, NULL, 1382326986, 1389781290),
(2, '天津泥人张', 5, NULL, 0, 0, 0, '/upload/image/product/201401/20140115102150_68038.jpg', '/upload/image/product/201401/20140115102155_80076.jpg', 0, 0, 0, '150.00', '120.00', NULL, NULL, 1389781207, 1389781315);

-- --------------------------------------------------------

--
-- 表的结构 `v_product_comment`
--

CREATE TABLE IF NOT EXISTS `v_product_comment` (
  `id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `member_id` int(10) NOT NULL,
  `content` text NOT NULL,
  `star` int(11) NOT NULL,
  `audit` int(1) NOT NULL DEFAULT '0',
  `hot` int(1) NOT NULL DEFAULT '0',
  `create_time` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `v_product_comment`
--

INSERT INTO `v_product_comment` (`id`, `product_id`, `member_id`, `content`, `star`, `audit`, `hot`, `create_time`) VALUES
(1, 1, 1, '“将军府”不过是一幅非常老套的升官发财图。这个故事当中，有“一人得道，鸡犬升天”，也有家人有恃无恐、横行乡里。', 2, 1, 1, 1389838067);

-- --------------------------------------------------------

--
-- 表的结构 `v_session`
--

CREATE TABLE IF NOT EXISTS `v_session` (
  `id` char(32) NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `data` longblob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `v_session`
--

INSERT INTO `v_session` (`id`, `expire`, `data`) VALUES
('0sus8mqufgqm7ke3dtgq37a3o2', 1389925903, 0x61646d696e5f5f61646d696e496e666f7c613a31353a7b733a323a226964223b733a313a2231223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a383a2270617373776f7264223b733a393a2261646d696e31323334223b733a383a2267726f75705f6964223b733a313a2231223b733a353a226175646974223b733a313a2231223b733a343a226e616d65223b733a31353a22e8b685e7baa7e7aea1e79086e59198223b733a363a2267656e646572223b733a313a2230223b733a353a22656d61696c223b733a31343a224d7465646479403132362e636f6d223b733a353a2270686f6e65223b733a31313a223135383134343439393236223b733a373a2261646472657373223b733a363a22e4b8ade59bbd223b733a31353a226c6173745f6c6f67696e5f74696d65223b733a31303a2231333839383336373036223b733a31363a226c6173745f6c6f676f75745f74696d65223b733a31303a2231333839373832323635223b733a31313a226c6f67696e5f74696d6573223b733a343a2231323535223b733a31313a226372656174655f74696d65223b733a31303a2231333238383634343430223b733a31313a227570646174655f74696d65223b733a31303a2231333839373832323635223b7d61646d696e5f5f69647c733a313a2231223b61646d696e5f5f6e616d657c733a353a2261646d696e223b61646d696e69647c733a313a2231223b61646d696e757365726e616d657c733a353a2261646d696e223b61646d696e70617373776f72647c733a393a2261646d696e31323334223b61646d696e67726f75705f69647c733a313a2231223b61646d696e61756469747c733a313a2231223b61646d696e6e616d657c733a31353a22e8b685e7baa7e7aea1e79086e59198223b61646d696e67656e6465727c733a313a2230223b61646d696e656d61696c7c733a31343a224d7465646479403132362e636f6d223b61646d696e70686f6e657c733a31313a223135383134343439393236223b61646d696e616464726573737c733a363a22e4b8ade59bbd223b61646d696e6c6173745f6c6f67696e5f74696d657c733a31303a2231333839383336373036223b61646d696e6c6173745f6c6f676f75745f74696d657c733a31303a2231333839373832323635223b61646d696e6c6f67696e5f74696d65737c733a343a2231323535223b61646d696e6372656174655f74696d657c733a31303a2231333238383634343430223b61646d696e7570646174655f74696d657c733a31303a2231333839373832323635223b61646d696e5f5f7374617465737c613a31353a7b733a323a226964223b623a313b733a383a22757365726e616d65223b623a313b733a383a2270617373776f7264223b623a313b733a383a2267726f75705f6964223b623a313b733a353a226175646974223b623a313b733a343a226e616d65223b623a313b733a363a2267656e646572223b623a313b733a353a22656d61696c223b623a313b733a353a2270686f6e65223b623a313b733a373a2261646472657373223b623a313b733a31353a226c6173745f6c6f67696e5f74696d65223b623a313b733a31363a226c6173745f6c6f676f75745f74696d65223b623a313b733a31313a226c6f67696e5f74696d6573223b623a313b733a31313a226372656174655f74696d65223b623a313b733a31313a227570646174655f74696d65223b623a313b7d);

-- --------------------------------------------------------

--
-- 表的结构 `v_site`
--

CREATE TABLE IF NOT EXISTS `v_site` (
  `id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `photo1` varchar(100) DEFAULT NULL,
  `http` varchar(100) DEFAULT NULL,
  `copyright` text,
  `update_time` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `v_site`
--

INSERT INTO `v_site` (`id`, `title`, `photo1`, `http`, `copyright`, `update_time`) VALUES
(1, '北京', '/upload/image/site/201311/20131106083101_26023.jpg', 'http://www.baidu.com/', '北京', 1383726661);

-- --------------------------------------------------------

--
-- 表的结构 `v_type`
--

CREATE TABLE IF NOT EXISTS `v_type` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `component` varchar(50) DEFAULT NULL,
  `lft` int(10) NOT NULL DEFAULT '0',
  `rgt` int(10) NOT NULL DEFAULT '0',
  `parent` int(10) NOT NULL DEFAULT '0',
  `depth` int(10) DEFAULT '1',
  `content` text,
  `audit` int(1) DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `update_time` int(15) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `lft` (`lft`,`rgt`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `v_type`
--

INSERT INTO `v_type` (`id`, `name`, `component`, `lft`, `rgt`, `parent`, `depth`, `content`, `audit`, `title`, `description`, `keyword`, `update_time`) VALUES
(1, '案例', NULL, 1, 6, 0, 1, NULL, 1, NULL, NULL, NULL, 1389085727),
(2, '美图', NULL, 7, 12, 0, 1, NULL, 1, NULL, NULL, NULL, 1389085747),
(3, '经典案例', NULL, 2, 3, 1, 2, NULL, 1, NULL, NULL, NULL, 1389085766),
(4, '优秀案例', NULL, 4, 5, 1, 2, NULL, 1, NULL, NULL, NULL, 1389085778),
(5, '动漫图片', NULL, 8, 9, 2, 2, NULL, 1, NULL, NULL, NULL, 1389085805),
(6, '写真图片', NULL, 10, 11, 2, 2, NULL, 1, NULL, NULL, NULL, 1389085827);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
