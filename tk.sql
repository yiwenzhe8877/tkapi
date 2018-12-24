-- --------------------------------------------------------
-- 主机:                           127.0.0.1
-- 服务器版本:                        5.5.53 - MySQL Community Server (GPL)
-- 服务器操作系统:                      Win32
-- HeidiSQL 版本:                  9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- 导出 yiicms 的数据库结构
CREATE DATABASE IF NOT EXISTS `yiicms` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `yiicms`;

-- 导出  表 yiicms.tk_admin_auth 结构
CREATE TABLE IF NOT EXISTS `tk_admin_auth` (
  `auth_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` varchar(32) NOT NULL COMMENT '权限名称',
  `module` varchar(32) NOT NULL DEFAULT '' COMMENT '模块名',
  `controller` varchar(32) NOT NULL DEFAULT '' COMMENT '控制器名称',
  `action` varchar(32) NOT NULL DEFAULT '' COMMENT '方法名称',
  `sort` int(10) NOT NULL DEFAULT '50' COMMENT '排序',
  `del` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '''del=0''=>''未删除'', ''del=1''=>''已删除'',',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1使用0禁用',
  PRIMARY KEY (`auth_id`)
) ENGINE=InnoDB AUTO_INCREMENT=371 DEFAULT CHARSET=utf8 COMMENT='后台权限表';

-- 数据导出被取消选择。
-- 导出  表 yiicms.tk_admin_group 结构
CREATE TABLE IF NOT EXISTS `tk_admin_group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '管理组id',
  `group_name` varchar(50) NOT NULL COMMENT '组名称',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1表示启用,0表示关闭的',
  `del` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0表示未删除，1表示删除',
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COMMENT='后台管理组';

-- 数据导出被取消选择。
-- 导出  表 yiicms.tk_admin_group_auth 结构
CREATE TABLE IF NOT EXISTS `tk_admin_group_auth` (
  `group_id` int(11) NOT NULL COMMENT '管理组id',
  `auth_id` int(10) unsigned NOT NULL COMMENT '权限id',
  `status` tinyint(4) DEFAULT '1' COMMENT '1表示有，0表示没有',
  PRIMARY KEY (`group_id`,`auth_id`),
  KEY `group_id` (`group_id`),
  KEY `auth_id` (`auth_id`),
  CONSTRAINT `FK_tk_group_auth_tk_auth` FOREIGN KEY (`auth_id`) REFERENCES `tk_admin_auth` (`auth_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tk_group_auth_tk_group` FOREIGN KEY (`group_id`) REFERENCES `tk_admin_group` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理组和权限关联表';

-- 数据导出被取消选择。
-- 导出  表 yiicms.tk_admin_menu 结构
CREATE TABLE IF NOT EXISTS `tk_admin_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL COMMENT '菜单名',
  `router` varchar(50) DEFAULT NULL COMMENT '路由',
  `pid` int(11) DEFAULT NULL COMMENT '父id',
  `sort` int(11) DEFAULT '1' COMMENT '排序id',
  `del` tinyint(1) DEFAULT '0' COMMENT '删除标志',
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='后台菜单表';

-- 数据导出被取消选择。
-- 导出  表 yiicms.tk_admin_menu_group 结构
CREATE TABLE IF NOT EXISTS `tk_admin_menu_group` (
  `menu_id` int(11) NOT NULL COMMENT '菜单id',
  `group_id` int(11) NOT NULL COMMENT '用户组id',
  `status` tinyint(4) DEFAULT NULL COMMENT '1开启0关闭',
  PRIMARY KEY (`menu_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='后台菜单用户组关联表';

-- 数据导出被取消选择。
-- 导出  表 yiicms.tk_admin_user 结构
CREATE TABLE IF NOT EXISTS `tk_admin_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '管理员id',
  `username` varchar(50) NOT NULL COMMENT '管理员账号名',
  `password` varchar(255) NOT NULL COMMENT '管理员密码',
  `nickname` varchar(255) NOT NULL COMMENT '昵称',
  `phone` varchar(11) NOT NULL COMMENT '手机号',
  `group_id` int(11) NOT NULL COMMENT '管理组id',
  `group_name` varchar(50) DEFAULT NULL COMMENT '管理组名称',
  `auth_key` varchar(50) NOT NULL COMMENT '密钥',
  `status` tinyint(1) DEFAULT '1' COMMENT '1表示启用,0表示不启用',
  `del` tinyint(1) DEFAULT '0' COMMENT '0未删除，1删除',
  `avatar` varchar(200) DEFAULT NULL COMMENT '头像',
  PRIMARY KEY (`user_id`),
  KEY `username` (`username`),
  KEY `tk_admin_user_group_id` (`group_id`),
  KEY `auth_key` (`auth_key`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8 COMMENT='后台管理员';

-- 数据导出被取消选择。
-- 导出  表 yiicms.tk_admin_user_group 结构
CREATE TABLE IF NOT EXISTS `tk_admin_user_group` (
  `user_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  KEY `FK_tk_user_group_tk_group` (`group_id`),
  KEY `FK_tk_user_group_tk_user` (`user_id`),
  CONSTRAINT `FK_tk_user_group_tk_group` FOREIGN KEY (`group_id`) REFERENCES `tk_admin_group` (`group_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_tk_user_group_tk_user` FOREIGN KEY (`user_id`) REFERENCES `tk_admin_user` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员和管理组关联表';

-- 数据导出被取消选择。
-- 导出  表 yiicms.tk_api_exceptionlog 结构
CREATE TABLE IF NOT EXISTS `tk_api_exceptionlog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `username` varchar(50) NOT NULL DEFAULT '0' COMMENT '用户',
  `group_name` varchar(50) NOT NULL DEFAULT '0' COMMENT '用户组',
  `range` tinyint(4) NOT NULL COMMENT '1表示后台管理员用户，2表示前端用户',
  `time` int(11) NOT NULL COMMENT '时间',
  `class` varchar(50) NOT NULL COMMENT '类',
  `method` varchar(50) NOT NULL COMMENT '方法',
  `line` varchar(50) NOT NULL COMMENT '行',
  `code` varchar(50) NOT NULL COMMENT '错误码',
  `msg` varchar(50) NOT NULL COMMENT '错误文本',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1028 DEFAULT CHARSET=utf8 COMMENT='api错误日志';

-- 数据导出被取消选择。
-- 导出  表 yiicms.tk_api_log 结构
CREATE TABLE IF NOT EXISTS `tk_api_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `time` int(11) NOT NULL COMMENT '时间',
  `username` varchar(50) NOT NULL COMMENT '调用者',
  `group` varchar(50) NOT NULL COMMENT '调用者属于的类别',
  `module` varchar(50) NOT NULL COMMENT '模块名',
  `class` varchar(50) NOT NULL COMMENT '类名',
  `method` varchar(50) NOT NULL COMMENT '方法名',
  `result` tinyint(4) NOT NULL COMMENT '调用结果(1ok,0fail)',
  `result_msg` text NOT NULL COMMENT '返回的数据',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='接口调用日志';

-- 数据导出被取消选择。
-- 导出  表 yiicms.tk_article 结构
CREATE TABLE IF NOT EXISTS `tk_article` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文章id',
  `dateline` int(11) NOT NULL COMMENT '发布时间',
  `title` varchar(255) NOT NULL COMMENT '发布标题',
  `content` text NOT NULL COMMENT '发布内容',
  `view` int(11) NOT NULL COMMENT '阅读量',
  PRIMARY KEY (`article_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='文章表';

-- 数据导出被取消选择。
-- 导出  表 yiicms.tk_article_category 结构
CREATE TABLE IF NOT EXISTS `tk_article_category` (
  `article_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  KEY `FK_tk_article_category_tk_article` (`article_id`),
  KEY `FK_tk_article_category_tk_category` (`category_id`),
  CONSTRAINT `FK_tk_article_category_tk_article` FOREIGN KEY (`article_id`) REFERENCES `tk_article` (`article_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tk_article_category_tk_category` FOREIGN KEY (`category_id`) REFERENCES `tk_category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章分类关联表';

-- 数据导出被取消选择。
-- 导出  表 yiicms.tk_category 结构
CREATE TABLE IF NOT EXISTS `tk_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '分类id',
  `name` varchar(50) NOT NULL COMMENT '分类名称',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章分类';

-- 数据导出被取消选择。
-- 导出  表 yiicms.tk_member_addr 结构
CREATE TABLE IF NOT EXISTS `tk_member_addr` (
  `addr_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `contname` varchar(200) NOT NULL COMMENT '姓名',
  `address` varchar(500) NOT NULL COMMENT '地址',
  `postalcode` varchar(20) DEFAULT NULL COMMENT '邮编',
  `telphone` varchar(200) DEFAULT NULL COMMENT '电话',
  `mobile` varchar(200) DEFAULT NULL COMMENT '手机',
  `remark` longtext COMMENT '备注',
  `is_deliver` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '作为发货地址',
  `is_return` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '作为退货地址',
  `is_selffetch` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '作为自提点地址',
  `province` varchar(255) DEFAULT NULL COMMENT '省',
  `city` varchar(255) DEFAULT NULL COMMENT '区市',
  `dist` varchar(255) DEFAULT NULL COMMENT '县',
  `community` varchar(255) DEFAULT NULL COMMENT '街道',
  `sort` mediumint(8) unsigned DEFAULT '0' COMMENT '顺序',
  `is_show` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示 ，1显示 0不显示',
  `is_default` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '默认地址 1默认，0不默认',
  PRIMARY KEY (`addr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34429 DEFAULT CHARSET=utf8 COMMENT='用户地址表';

-- 数据导出被取消选择。
-- 导出  表 yiicms.tk_member_base 结构
CREATE TABLE IF NOT EXISTS `tk_member_base` (
  `member_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `pam_account` varchar(100) DEFAULT NULL COMMENT '普通帐号',
  `pam_openid` varchar(200) DEFAULT NULL COMMENT '用户的openid',
  `pam_phone` varchar(50) DEFAULT NULL COMMENT '电话号码',
  `pam_email` varchar(100) DEFAULT NULL COMMENT '邮箱帐号',
  `pam_unionid` varchar(200) DEFAULT NULL COMMENT '用户的unionid',
  `password` varchar(32) DEFAULT NULL COMMENT '密码,经过md5加密',
  `paypassword` varchar(32) DEFAULT NULL COMMENT '支付密码,经过md5加密',
  `auth_key` varchar(10) DEFAULT NULL COMMENT '授权码，带上请求接口',
  `is_locked` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态:1锁定 0正常',
  `groupid` smallint(6) unsigned DEFAULT NULL COMMENT '用户组id',
  `groupname` varchar(50) DEFAULT NULL COMMENT '用户组名称',
  `money` decimal(20,3) NOT NULL DEFAULT '0.000' COMMENT '预存款',
  `point` int(11) NOT NULL DEFAULT '0' COMMENT '积分',
  `experience` int(11) NOT NULL DEFAULT '0' COMMENT '经验',
  `regdate` int(10) unsigned DEFAULT NULL COMMENT '注册时间',
  `regip` varchar(20) DEFAULT NULL COMMENT '注册ip',
  `regip_area` varchar(250) DEFAULT NULL COMMENT '注册ip所在的地区',
  `source` enum('pc','wap','weixin','api','app') DEFAULT NULL COMMENT '来路',
  `ordernum` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '订单数量',
  `newprompt` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '新通知',
  `emailstatus` enum('normal','wait','success') DEFAULT NULL COMMENT '邮箱验证状态',
  `mobilestatus` enum('normal','wait','success') DEFAULT NULL COMMENT '手机验证状态',
  `nickname` varchar(100) DEFAULT NULL COMMENT '显示昵称',
  `wxnumber` varchar(50) DEFAULT NULL COMMENT '微信号',
  `realname` varchar(50) DEFAULT NULL COMMENT '真实姓名',
  `zhifubao` varchar(50) DEFAULT NULL COMMENT '支付宝',
  `parent_openid` varchar(200) DEFAULT NULL COMMENT '父级的openid',
  PRIMARY KEY (`member_id`),
  KEY `Index_2` (`regdate`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=41979 DEFAULT CHARSET=utf8 COMMENT='用户基表';

-- 数据导出被取消选择。
-- 导出  表 yiicms.tk_member_cart 结构
CREATE TABLE IF NOT EXISTS `tk_member_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) DEFAULT NULL COMMENT '用户id',
  `product_id` int(11) DEFAULT NULL COMMENT '具体商品id',
  `goods_id` int(11) DEFAULT NULL COMMENT '商品id',
  `num` int(11) DEFAULT NULL COMMENT '数量',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户购物车';

-- 数据导出被取消选择。
-- 导出  表 yiicms.tk_member_comment 结构
CREATE TABLE IF NOT EXISTS `tk_member_comment` (
  `dis_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '评论id',
  `goods_id` bigint(20) NOT NULL DEFAULT '0' COMMENT '商品id',
  `store_id` int(11) NOT NULL DEFAULT '0' COMMENT '店铺id',
  `member_id` int(11) NOT NULL DEFAULT '0' COMMENT '主 id',
  `member_name` varchar(20) NOT NULL DEFAULT '0' COMMENT '主 name',
  `dis_text` varchar(500) DEFAULT '' COMMENT '评论内容',
  `t_member_id` int(11) NOT NULL DEFAULT '0' COMMENT '从 id',
  `t_member_name` varchar(20) NOT NULL DEFAULT '' COMMENT '从 name',
  `dis_time` int(11) NOT NULL DEFAULT '0' COMMENT '评论时间',
  `dis_bool` int(11) DEFAULT '0' COMMENT '是否查看，1：已查看；0：未查看',
  PRIMARY KEY (`dis_id`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=utf8 COMMENT='用户评论表';

-- 数据导出被取消选择。
-- 导出  表 yiicms.tk_member_consult 结构
CREATE TABLE IF NOT EXISTS `tk_member_consult` (
  `con_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `member_id` int(10) unsigned NOT NULL COMMENT '用户id',
  `username` varchar(100) DEFAULT NULL COMMENT '用户名',
  `goods_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '商品id',
  `product_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '产品id',
  `order_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '订单id',
  `object_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '咨询类型：售前;售后;投诉',
  `mem_read_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '会员是否已经阅读',
  `adm_read_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '管理员是否已经阅读',
  `lastreply` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后回复时间',
  `reply_name` varchar(100) NOT NULL COMMENT '最后回复人',
  `display` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '前台是否显示',
  `useful` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '有用数，用户点击一次代表有用+1，并且记录IP,不能重复使用。',
  `replies` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '回复数',
  `userdel` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '用户删除标识',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '时间',
  `name` varchar(500) DEFAULT NULL COMMENT '名称',
  `reply_uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '回复者id',
  `adm_write_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '管理员是否已经答复',
  `contact` varchar(500) DEFAULT NULL COMMENT '联系方式',
  `store_id` int(11) DEFAULT NULL COMMENT '店铺id',
  PRIMARY KEY (`con_id`),
  KEY `Index_2` (`goods_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='咨询问答表';

-- 数据导出被取消选择。
-- 导出  表 yiicms.tk_member_evaluat 结构
CREATE TABLE IF NOT EXISTS `tk_member_evaluat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `member_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `username` varchar(100) DEFAULT NULL COMMENT '用户名',
  `goods_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '商品id',
  `product_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '产品id',
  `order_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '订单编号',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '时间',
  `display` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '显示',
  `useful` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '有用+1',
  `replies` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '回复数',
  `userdel` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '用户删除',
  `goods_name` varchar(500) DEFAULT NULL COMMENT '商品名称',
  `eval_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '好评, 中评,差评',
  `point_goods` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '宝贝描述打分1-5分',
  `point_service` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '服务态度打分1-5分',
  `point_express` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '发货速度打分1-5分',
  `adm_write_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '管理员有无回复',
  `adm_read_status` tinyint(1) unsigned DEFAULT '0',
  `issystem` tinyint(1) unsigned DEFAULT '0' COMMENT '是否为系统评价',
  `store_id` int(10) unsigned DEFAULT '0' COMMENT '店铺id',
  PRIMARY KEY (`id`),
  KEY `Index_2` (`goods_id`),
  KEY `Index_3` (`adm_read_status`,`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='用户评价表';

-- 数据导出被取消选择。
-- 导出  表 yiicms.tk_member_favorite 结构
CREATE TABLE IF NOT EXISTS `tk_member_favorite` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `member_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `goods_id` bigint(20) unsigned DEFAULT '0' COMMENT '商品id',
  `product_id` bigint(20) unsigned DEFAULT '0' COMMENT '产品id',
  `goods_name` varchar(500) DEFAULT NULL COMMENT '商品名称',
  `goods_price` decimal(20,3) DEFAULT '0.000' COMMENT '商品价格',
  `type` tinyint(1) unsigned DEFAULT '0' COMMENT '类型:收藏; 降价通知(保留),到货通知(保留)',
  `remark` varchar(500) DEFAULT NULL COMMENT '备注',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '时间',
  `sendtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '时间',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态 是否通知',
  `cellphone` varchar(15) DEFAULT NULL COMMENT '手机',
  `email` varchar(100) DEFAULT NULL COMMENT '邮箱',
  `disabled` tinyint(1) unsigned DEFAULT '0' COMMENT '禁用',
  `pic1` varchar(500) DEFAULT NULL COMMENT '商品缩略图',
  PRIMARY KEY (`id`),
  KEY `Index_2` (`member_id`,`type`,`goods_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='用户收藏夹';

-- 数据导出被取消选择。
-- 导出  表 yiicms.tk_member_footprint 结构
CREATE TABLE IF NOT EXISTS `tk_member_footprint` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(10) unsigned NOT NULL,
  `goods_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `goods_name` varchar(500) NOT NULL,
  `goods_price` decimal(20,3) NOT NULL DEFAULT '0.000',
  `dateline` int(10) unsigned NOT NULL,
  `pic1` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_2` (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=480 DEFAULT CHARSET=utf8 COMMENT='用户浏览足迹';

-- 数据导出被取消选择。
-- 导出  表 yiicms.tk_member_group 结构
CREATE TABLE IF NOT EXISTS `tk_member_group` (
  `groupid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户组id',
  `name` varchar(100) NOT NULL COMMENT '组名称',
  `logo` varchar(255) DEFAULT NULL COMMENT 'logo标识',
  `dis_count` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '享受的会员折扣',
  `experience` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '升级所需要的经验',
  `isdefault` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '作为默认注册用户组',
  `is_enabled` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1启用，0禁用',
  `day_limit` mediumint(9) NOT NULL DEFAULT '0' COMMENT '会员每日下单限制：0代表不限制，-1代表禁止下单。如10代表每天最多下10个订单。',
  `day_limit_price` int(11) NOT NULL DEFAULT '0' COMMENT '次下单必须达到的金额：0表示不限制。不符合标准无法下单',
  `remark` text NOT NULL COMMENT '备注',
  `access_type` enum('private','public','super') NOT NULL DEFAULT 'public' COMMENT '访问权限',
  `custom` longtext NOT NULL COMMENT '扩展字段',
  `displayorder` mediumint(8) NOT NULL DEFAULT '0',
  `day_consult` mediumint(8) unsigned DEFAULT '0' COMMENT '每天最多咨询数',
  `notupdate` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否不参与升级',
  PRIMARY KEY (`groupid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='用户组';

-- 数据导出被取消选择。
-- 导出  表 yiicms.tk_member_loginlog 结构
CREATE TABLE IF NOT EXISTS `tk_member_loginlog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `member_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `ip` varchar(50) DEFAULT NULL COMMENT 'ip地址',
  `ip_area` varchar(500) DEFAULT NULL COMMENT 'ip地址所在的地区',
  `dateline` int(10) unsigned DEFAULT NULL COMMENT '时间',
  `username` varchar(100) DEFAULT NULL COMMENT '用户名',
  `browser` varchar(100) DEFAULT NULL COMMENT '浏览器版本',
  `platform` varchar(100) DEFAULT NULL COMMENT '平台系统',
  `user_agent` varchar(500) DEFAULT NULL COMMENT 'adminUser-agent标识',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43460 DEFAULT CHARSET=utf8 COMMENT='用户登录日志表';

-- 数据导出被取消选择。
-- 导出  表 yiicms.tk_member_money 结构
CREATE TABLE IF NOT EXISTS `tk_member_money` (
  `logid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `member_id` int(10) unsigned NOT NULL COMMENT '用户id',
  `money` decimal(20,3) NOT NULL DEFAULT '0.000' COMMENT '改变之前的余额',
  `change_money` decimal(20,3) NOT NULL DEFAULT '0.000' COMMENT '改变金额，正负数',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '时间',
  `reason` varchar(50) DEFAULT NULL COMMENT '理由',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `operatorid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '操作员ID',
  `operator` varchar(50) DEFAULT NULL COMMENT '操作员',
  `related_id` varchar(255) NOT NULL DEFAULT '0' COMMENT '关联对象ID',
  `realmoudle` enum('order','comment','register','additon','payment','withdraw','offline') DEFAULT NULL COMMENT '关联模块：order:订单;comment:评论;register:注册;additon:额外人工;payment:充值;withdraw提现,offline:线下充值',
  PRIMARY KEY (`logid`)
) ENGINE=InnoDB AUTO_INCREMENT=153 DEFAULT CHARSET=utf8 COMMENT='预存款日志表';

-- 数据导出被取消选择。
-- 导出  表 yiicms.tk_member_msg 结构
CREATE TABLE IF NOT EXISTS `tk_member_msg` (
  `msg_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `from_uid` int(10) unsigned DEFAULT NULL COMMENT '发信者ID',
  `from_username` varchar(100) DEFAULT NULL COMMENT '发信者',
  `to_uid` int(10) unsigned DEFAULT NULL COMMENT '收信者ID',
  `to_username` varchar(100) DEFAULT NULL COMMENT '收信者',
  `subject` varchar(500) DEFAULT NULL COMMENT '消息主题',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发送时间',
  `totime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '到达时间',
  `isread` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否阅读',
  `replies` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '回复数',
  `lastreply` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后回复时间',
  `reply_name` varchar(100) DEFAULT NULL COMMENT '最后回复人',
  `disabled` tinyint(1) unsigned DEFAULT '0' COMMENT '禁用',
  `fromdel` tinyint(1) unsigned DEFAULT '0' COMMENT '发送者删除',
  `todel` tinyint(1) unsigned DEFAULT '0' COMMENT '接收者删除',
  PRIMARY KEY (`msg_id`),
  KEY `Index_2` (`to_uid`)
) ENGINE=InnoDB AUTO_INCREMENT=15912 DEFAULT CHARSET=utf8 COMMENT='用户消息';

-- 数据导出被取消选择。
-- 导出  表 yiicms.tk_member_point 结构
CREATE TABLE IF NOT EXISTS `tk_member_point` (
  `logid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `member_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `point` int(10) NOT NULL DEFAULT '0' COMMENT '改变之后的分数',
  `change_point` int(10) NOT NULL DEFAULT '0' COMMENT '改变积分，正负数',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '时间',
  `reason` varchar(255) DEFAULT NULL COMMENT '理由',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `operatorid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '操作员ID',
  `operator` varchar(50) NOT NULL COMMENT '操作员',
  `related_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '关联对象ID',
  `realmoudle` enum('order','comment','register','additon') NOT NULL COMMENT '关联模块：order:订单;comment:评论;register:注册;additon:额外人工',
  PRIMARY KEY (`logid`),
  KEY `Index_2` (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=483994 DEFAULT CHARSET=utf8 COMMENT='积分日志表';

-- 数据导出被取消选择。
-- 导出  表 yiicms.tk_member_profile 结构
CREATE TABLE IF NOT EXISTS `tk_member_profile` (
  `member_id` int(10) unsigned NOT NULL COMMENT '会员id',
  `realname` varchar(255) DEFAULT NULL COMMENT '实名',
  `gender` tinyint(1) unsigned DEFAULT '0' COMMENT '性别n(0:保密 1:男 2:女 3：其它)',
  `birthyear` smallint(6) unsigned DEFAULT '0' COMMENT '生日',
  `birthmonth` tinyint(3) unsigned DEFAULT '0',
  `birthday` tinyint(3) unsigned DEFAULT '0',
  `constellation` varchar(255) DEFAULT NULL COMMENT '星座(根据生日自动计算)',
  `zodiac` varchar(255) DEFAULT NULL COMMENT '生肖(根据生日自动计算)',
  `telphone` varchar(255) DEFAULT NULL COMMENT '固定电话',
  `mobile` varchar(255) DEFAULT NULL COMMENT '手机',
  `idcardtype` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '证件类型：身份证 护照 军官证等',
  `idcard` varchar(255) DEFAULT NULL COMMENT '证件号码',
  `address` varchar(255) DEFAULT NULL COMMENT '邮寄地址',
  `zipcode` varchar(255) DEFAULT NULL COMMENT '邮编',
  `nationality` varchar(255) DEFAULT NULL COMMENT '国籍',
  `birthprovince` varchar(255) DEFAULT NULL COMMENT '出生省份',
  `birthcity` varchar(255) DEFAULT NULL COMMENT '出生城市',
  `birthdist` varchar(255) DEFAULT NULL COMMENT '出生行政区/县',
  `birthcommunity` varchar(255) DEFAULT NULL COMMENT '出生小区',
  `residesuite` varchar(255) DEFAULT NULL COMMENT '小区、写字楼门牌号',
  `graduateschool` varchar(255) DEFAULT NULL COMMENT '毕业学校',
  `company` varchar(255) DEFAULT NULL COMMENT '公司',
  `education` varchar(255) DEFAULT NULL COMMENT '学历',
  `occupation` varchar(255) DEFAULT NULL COMMENT '职业',
  `position` varchar(255) DEFAULT NULL COMMENT '职位',
  `revenue` varchar(255) DEFAULT NULL COMMENT '年收入',
  `affectiverstatus` varchar(255) DEFAULT NULL COMMENT '情感状态',
  `bloodtype` varchar(255) DEFAULT NULL COMMENT '血型',
  `heihgt` varchar(255) DEFAULT NULL COMMENT '身高',
  `weight` varchar(255) DEFAULT NULL COMMENT '体重',
  `alipay` varchar(255) DEFAULT NULL COMMENT '支付宝',
  `qq` varchar(255) DEFAULT NULL COMMENT 'qq',
  `yahoo` varchar(255) DEFAULT NULL,
  `msn` varchar(255) DEFAULT NULL,
  `taobao` varchar(255) DEFAULT NULL,
  `site` varchar(255) DEFAULT NULL,
  `weixin` varchar(255) DEFAULT NULL,
  `bio` text COMMENT '自我介绍',
  `interest` text COMMENT '兴趣爱好',
  `timeoffset` varchar(255) DEFAULT NULL COMMENT '用户时区设置，9999代表默认时区',
  `field1` text,
  `field2` text,
  `field3` text,
  `field4` text,
  `field5` text,
  `field6` text,
  `field7` text,
  `field8` text,
  `field9` text,
  `field10` text,
  `lastupdate` int(10) unsigned DEFAULT '0',
  `haschildren` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `dist` varchar(255) DEFAULT NULL,
  `community` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL COMMENT '电子邮件',
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员信息表';

-- 数据导出被取消选择。
-- 导出  表 yiicms.tk_member_sysmsg 结构
CREATE TABLE IF NOT EXISTS `tk_member_sysmsg` (
  `msg_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `admin_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发信者ID',
  `username` varchar(100) DEFAULT NULL COMMENT '发信者',
  `to_type` tinyint(1) unsigned DEFAULT '0' COMMENT '发给谁：all:所有人;group:指定组;order:下单人;unorder:未下单人;appoint:指定',
  `subject` varchar(500) DEFAULT NULL COMMENT '消息主题',
  `pc_content` longtext COMMENT 'pc内容',
  `ip` varchar(50) DEFAULT NULL COMMENT 'ip地址',
  `ip_area` varchar(500) DEFAULT NULL COMMENT 'ip地址所在地区',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '时间',
  `expiration` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '过期时间;超过时间则群发无效',
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '禁用',
  `svalue` longtext COMMENT '指定值',
  `wap_content` longtext COMMENT 'wap内容',
  `sendall` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '发给所有人标识',
  `sendorder` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '发给订单用户标识',
  `sendnoorder` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '发给未订单用户标识',
  `sendgroupid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '发给指定用户组',
  `sendmember` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '发给指定的用户,配合svalue',
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='系统站内信表';

-- 数据导出被取消选择。
-- 导出  表 yiicms.tk_member_verif 结构
CREATE TABLE IF NOT EXISTS `tk_member_verif` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `member_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户编号',
  `ip` varchar(50) DEFAULT NULL COMMENT 'ip地址',
  `ip_area` varchar(255) DEFAULT NULL COMMENT 'ip地址所在地区',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '时间',
  `verif` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否验证',
  `obj_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'mobile:手机验证;email:电子邮箱验证',
  `obj_value` varchar(100) DEFAULT NULL COMMENT '待验证号码',
  `verifcode` varchar(10) NOT NULL COMMENT '验证码值',
  `expiration` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '过期时间;超时则无效',
  `behavior` tinyint(1) unsigned NOT NULL COMMENT 'register:注册;forgotpass:忘记密码;emailverif:邮箱认证;mobileverif:手机认证; unmobileverif:取消绑定;取消电子邮箱绑定',
  `username` varchar(100) DEFAULT NULL COMMENT '用户名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3039 DEFAULT CHARSET=utf8 COMMENT='验证码表';

-- 数据导出被取消选择。
-- 导出  表 yiicms.tk_order 结构
CREATE TABLE IF NOT EXISTS `tk_order` (
  `order_id` bigint(20) unsigned NOT NULL COMMENT '订单号',
  `store_id` int(11) NOT NULL DEFAULT '0',
  `store_name` varchar(200) NOT NULL,
  `store_member_id` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned DEFAULT '0' COMMENT '订单状态 0:活动订单;1:已完成；2:已作废;',
  `total_amount` decimal(20,3) NOT NULL DEFAULT '0.000' COMMENT '商品默认货币总值，商品的总价,不包含物流费用和促销费用等',
  `final_amount` decimal(20,3) NOT NULL DEFAULT '0.000' COMMENT '订单货币总值, 包含支付价格,税等',
  `pay_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '付款状态 0:未支付;1:已支付;2:已付款至到担保方;3:部分付款',
  `pay_type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '支付类型：1线上支付 2线下支付 3货到付款',
  `ship_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '发货状态 0:未发货;1:已发货;2:部分发货',
  `is_evaluat` tinyint(1) NOT NULL DEFAULT '0' COMMENT '用户是否已评价',
  `is_delivery` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否需要发货',
  `createtime` int(10) unsigned NOT NULL COMMENT '下单时间',
  `last_modified` int(10) unsigned NOT NULL COMMENT '最后更新时间',
  `payment` varchar(100) NOT NULL COMMENT '支付方式                                                                                     ',
  `shipping_id` mediumint(8) unsigned DEFAULT NULL COMMENT '配送方式',
  `shipping` varchar(100) DEFAULT NULL COMMENT '配送方式',
  `member_id` int(10) unsigned NOT NULL COMMENT '会员用户名',
  `ship_area` varchar(500) DEFAULT NULL COMMENT '收货地区',
  `ship_name` varchar(200) NOT NULL COMMENT '收货人',
  `weight` decimal(20,3) DEFAULT NULL COMMENT '订单总重量',
  `itemnum` mediumint(8) unsigned NOT NULL COMMENT '订单子订单数量',
  `ip` varchar(20) DEFAULT NULL COMMENT 'IP地址',
  `ip_area` varchar(255) DEFAULT NULL COMMENT 'IP地址所在地区',
  `ship_zip` varchar(20) DEFAULT NULL COMMENT '收货人邮编',
  `ship_tel` varchar(50) DEFAULT NULL COMMENT '收货电话',
  `ship_email` varchar(100) DEFAULT NULL COMMENT '收货人email',
  `ship_time` varchar(300) DEFAULT NULL COMMENT '配送时间',
  `ship_mobile` varchar(50) NOT NULL COMMENT '收货人手机',
  `tax_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '发票类型 0:不需发票;1:个人发票;2:公司发票;',
  `tax_content` varchar(500) DEFAULT NULL COMMENT '发票内容',
  `cost_tax` decimal(20,3) DEFAULT NULL COMMENT '订单税率',
  `tax_company` varchar(500) DEFAULT NULL COMMENT '发票抬头',
  `is_protect` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否还有保价费',
  `cost_protect` decimal(20,3) DEFAULT NULL COMMENT '保价费',
  `cost_payment` decimal(20,3) DEFAULT NULL COMMENT '支付费用 总费用  暂时保留',
  `currency` varchar(8) NOT NULL DEFAULT 'CNY' COMMENT '订单支付货币',
  `cur_rate` decimal(10,4) DEFAULT NULL COMMENT '订单支付货币汇率',
  `score_u` decimal(20,3) NOT NULL DEFAULT '0.000' COMMENT '订单使用积分',
  `score_g` decimal(20,3) NOT NULL DEFAULT '0.000' COMMENT '订单获得积分',
  `discount` decimal(20,3) NOT NULL DEFAULT '0.000' COMMENT '订单减免',
  `pmt_goods` decimal(20,3) NOT NULL DEFAULT '0.000' COMMENT '商品促销优惠',
  `pmt_order` decimal(20,3) NOT NULL DEFAULT '0.000' COMMENT '订单促销优惠',
  `payed` decimal(20,3) NOT NULL DEFAULT '0.000' COMMENT '订单支付金额 实际支付的金额',
  `memo` longtext COMMENT '订单附言',
  `disabled` tinyint(1) DEFAULT '0' COMMENT '是否失效 初期不用这个字段，作为保留字段',
  `mark_text` longtext COMMENT '订单备注',
  `cost_freight` decimal(20,3) DEFAULT '0.000' COMMENT '配送费用',
  `order_refer` varchar(20) DEFAULT NULL COMMENT '订单来源',
  `addon` longtext COMMENT '订单附属信息(序列化)',
  `source` tinyint(1) DEFAULT NULL COMMENT '平台来源 0:标准平台; 1:手机触屏; 2:微信商城; 3:API接口',
  `confim_day` tinyint(3) unsigned NOT NULL COMMENT '自动确认收货时间，比如7天时间等。',
  `username` varchar(100) DEFAULT NULL COMMENT '会员用户名全名',
  `paytime` int(10) unsigned DEFAULT NULL COMMENT '付款时间',
  `shiptime` int(10) unsigned DEFAULT NULL COMMENT '发货时间',
  `evaluattime` int(10) unsigned DEFAULT NULL COMMENT '完成时间',
  `refund_status` tinyint(1) unsigned DEFAULT '0' COMMENT '0 无售后处理 1有售后待处理',
  `experience` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '经验值',
  `volume` decimal(20,3) NOT NULL DEFAULT '0.000' COMMENT '体积',
  `ship_area_china` varchar(255) NOT NULL COMMENT '收货地区',
  `province` varchar(100) NOT NULL COMMENT '收货地区数据结构',
  `city` varchar(100) NOT NULL COMMENT '收货地区数据结构',
  `dist` varchar(100) NOT NULL COMMENT '收货地区数据结构',
  `community` varchar(100) NOT NULL COMMENT '收货地区数据结构',
  `is_start` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `last_modifier` varchar(100) DEFAULT NULL,
  `display` tinyint(1) unsigned DEFAULT '0' COMMENT '是否隐藏该订单',
  PRIMARY KEY (`order_id`),
  KEY `Index_2` (`createtime`),
  KEY `Index_4` (`ship_status`),
  KEY `Index_5` (`refund_status`),
  KEY `Index_6` (`status`),
  KEY `Index_3` (`pay_status`,`createtime`) USING BTREE,
  KEY `Index_7` (`member_id`),
  KEY `Index_8` (`paytime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单表';

-- 数据导出被取消选择。
-- 导出  表 yiicms.tk_order_base 结构
CREATE TABLE IF NOT EXISTS `tk_order_base` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `openid` varchar(50) DEFAULT NULL COMMENT 'openid',
  `orderid` varchar(50) NOT NULL COMMENT '订单号',
  `createtime` int(10) NOT NULL COMMENT '订单创建时间',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '订单状态,0表示未支付，1表示订单完成，2表示订单失败',
  `goodscnt` varchar(255) NOT NULL COMMENT '商品内容',
  `goodsid` varchar(50) NOT NULL COMMENT '商品id',
  `number` varchar(50) NOT NULL COMMENT '购买数量',
  `price` varchar(20) NOT NULL COMMENT '单件原价',
  `realpay` varchar(20) NOT NULL COMMENT '实际付款金额',
  `confirmtime` int(10) NOT NULL COMMENT '确认收货时间',
  `rate` varchar(10) NOT NULL COMMENT '佣金比例',
  `mycommission` decimal(20,0) NOT NULL COMMENT '我的佣金',
  `cuscommission` decimal(20,0) NOT NULL COMMENT '客户佣金',
  `parentopenid` varchar(200) DEFAULT NULL COMMENT '客户的上家',
  `parentcommission` decimal(20,0) NOT NULL COMMENT '客户上家获得的佣金',
  `siteid` int(10) NOT NULL COMMENT 'siteid',
  `adid` int(10) NOT NULL COMMENT 'adid',
  `is_used` tinyint(1) NOT NULL COMMENT '0表示未使用,1表示使用过了',
  PRIMARY KEY (`id`),
  KEY `openid` (`openid`,`orderid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='用户订单表';

-- 数据导出被取消选择。
-- 导出  表 yiicms.tk_order_delivery 结构
CREATE TABLE IF NOT EXISTS `tk_order_delivery` (
  `delivery_id` bigint(20) unsigned NOT NULL COMMENT '自增id',
  `order_id` bigint(20) unsigned DEFAULT NULL COMMENT '订单编号',
  `delivery_bn` varchar(100) DEFAULT NULL COMMENT '配送流水号',
  `money` decimal(20,3) DEFAULT NULL COMMENT '配送费用',
  `logi_id` mediumint(8) unsigned DEFAULT NULL COMMENT '需要物流，不需要物流',
  `logi_name` varchar(100) DEFAULT NULL COMMENT '物流公司I名称',
  `logi_no` varchar(100) DEFAULT NULL COMMENT '物流单号',
  `op_name` varchar(100) DEFAULT NULL COMMENT '操作者',
  `op_id` mediumint(8) unsigned DEFAULT NULL COMMENT '操作者id',
  `status` tinyint(1) unsigned DEFAULT NULL COMMENT '状态 succ:成功到达;failed:发货失败;cancel:已取消;lost:货物丢失;progress:运送中;timeout:超时;ready:准备发',
  `memo` text COMMENT '扩展备注',
  `disabled` tinyint(3) unsigned DEFAULT NULL COMMENT '禁用',
  `dateline` int(10) unsigned DEFAULT NULL COMMENT '时间',
  `lastupdate` int(10) unsigned DEFAULT NULL COMMENT '最后更新时间',
  `member_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '订货会员ID',
  `ship_name` varchar(200) DEFAULT NULL COMMENT '收货人姓名',
  `ship_area` varchar(255) DEFAULT NULL COMMENT '收货人地区',
  `ship_addr` varchar(500) DEFAULT NULL COMMENT '收货人地址',
  `ship_zip` varchar(20) DEFAULT NULL COMMENT '收货人邮编',
  `ship_tel` varchar(50) DEFAULT NULL COMMENT '收货人电话',
  `ship_mobile` varchar(50) DEFAULT NULL COMMENT '收货人手机',
  `ship_email` varchar(200) DEFAULT NULL COMMENT '收货人email',
  `dlycorp` mediumint(8) unsigned DEFAULT NULL COMMENT '物流公司id',
  PRIMARY KEY (`delivery_id`),
  KEY `Index_2` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='发货记录单';

-- 数据导出被取消选择。
-- 导出  表 yiicms.tk_order_deliveryitems 结构
CREATE TABLE IF NOT EXISTS `tk_order_deliveryitems` (
  `item_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `delivery_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '发货单id',
  `order_item_id` mediumint(8) unsigned DEFAULT '0' COMMENT '发货明细订单号',
  `item_type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '随同商品',
  `product_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `product_bn` varchar(50) DEFAULT NULL COMMENT '货品号',
  `product_name` varchar(500) DEFAULT NULL COMMENT '货品名称',
  `number` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '发货数量',
  `product_sku` varchar(200) NOT NULL COMMENT '商品sku',
  `goods_id` bigint(20) unsigned DEFAULT NULL COMMENT '商品id',
  PRIMARY KEY (`item_id`),
  KEY `idx_c_delivery_id` (`delivery_id`),
  KEY `idx_c_order_item_id` (`order_item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='发货单明细表';

-- 数据导出被取消选择。
-- 导出  表 yiicms.tk_order_downloadlog 结构
CREATE TABLE IF NOT EXISTS `tk_order_downloadlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `download_dateline` int(10) DEFAULT NULL COMMENT '下载时间',
  `startline` int(11) DEFAULT NULL COMMENT '订单开始日期',
  `endline` int(11) DEFAULT NULL COMMENT '订单结束日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单下载日志表';

-- 数据导出被取消选择。
-- 导出  表 yiicms.tk_order_items 结构
CREATE TABLE IF NOT EXISTS `tk_order_items` (
  `item_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `order_id` bigint(20) unsigned NOT NULL COMMENT '订单号',
  `goods_id` bigint(20) unsigned NOT NULL COMMENT '商品ID',
  `product_id` bigint(20) unsigned NOT NULL COMMENT '子商品ID  产品SKU',
  `name` varchar(200) NOT NULL COMMENT '明细商品的名称',
  `cost` decimal(20,3) unsigned NOT NULL DEFAULT '0.000' COMMENT '明细商品的成本',
  `price` decimal(20,3) unsigned NOT NULL DEFAULT '0.000' COMMENT '明细商品的销售价(购入价)',
  `g_price` decimal(20,3) unsigned NOT NULL DEFAULT '0.000' COMMENT '明细商品的会员价原价',
  `amount` decimal(20,3) unsigned NOT NULL DEFAULT '0.000' COMMENT '明细商品总额',
  `score` decimal(20,3) unsigned NOT NULL DEFAULT '0.000' COMMENT '明细商品积分',
  `weight` decimal(20,3) NOT NULL DEFAULT '0.000' COMMENT '明细商品重量',
  `nums` float unsigned NOT NULL DEFAULT '0' COMMENT '明细商品购买数量',
  `sendnum` float unsigned NOT NULL DEFAULT '0' COMMENT '明细商品发货数量',
  `addon` longtext COMMENT '明细商品的附加值算法',
  `item_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '明细商品类型 0:商品;1:捆绑商品;2:赠品商品;3:配件商品;',
  `refund_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '同退款单表字段',
  `ship_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:未发货;1:已发货;2:部分发货',
  `sku` varchar(400) NOT NULL COMMENT '具体的子产品sku名称',
  `sn_id` varchar(45) NOT NULL COMMENT '快照的id标识',
  `volume` decimal(20,3) NOT NULL DEFAULT '0.000' COMMENT '体积',
  `refunds_type` tinyint(3) unsigned NOT NULL,
  `pay_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '同主订单表的支付状态',
  `bn` varchar(100) DEFAULT NULL COMMENT '货号编码',
  PRIMARY KEY (`item_id`),
  KEY `FK_ssc_order_items_1` (`order_id`),
  KEY `Index_3` (`product_id`),
  KEY `Index_4` (`pay_status`,`goods_id`,`nums`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COMMENT='订单子表';

-- 数据导出被取消选择。
-- 导出  表 yiicms.tk_order_log 结构
CREATE TABLE IF NOT EXISTS `tk_order_log` (
  `log_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '日志ID(自增)',
  `order_id` bigint(20) unsigned NOT NULL COMMENT '订单编号',
  `op_id` mediumint(8) unsigned NOT NULL COMMENT '操作员ID',
  `op_name` varchar(100) NOT NULL COMMENT '操作人名称',
  `dateline` int(10) unsigned NOT NULL COMMENT '操作时间',
  `behavior` tinyint(2) unsigned NOT NULL COMMENT '日志记录操作的行为 1:创建;2:修改;3:支付;4:退款;5:发货;6:退货;7:完成;8:取消;;9:修改发货地址,10:修改价格,11:维权创建;12:评价;13:释放库存;14:撤销维权;15:订单隐藏',
  `result` tinyint(1) NOT NULL DEFAULT '1' COMMENT '日志结果 1:成功;2:失败;',
  `log_text` longtext NOT NULL COMMENT '操作内容',
  `addon` longtext COMMENT '序列化数据',
  `ip` varchar(20) DEFAULT NULL COMMENT 'IP地址',
  `ip_area` varchar(255) DEFAULT NULL COMMENT 'IP地址所在地区',
  PRIMARY KEY (`log_id`),
  KEY `Index_2` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8 COMMENT='订单日志表';

-- 数据导出被取消选择。
-- 导出  表 yiicms.tk_order_payments 结构
CREATE TABLE IF NOT EXISTS `tk_order_payments` (
  `payment_id` varchar(20) NOT NULL COMMENT '支付单号',
  `money` decimal(20,3) NOT NULL COMMENT '支付金额',
  `cur_money` decimal(20,3) NOT NULL COMMENT '支付货币金额 暂时不用，保留字段',
  `order_id` bigint(20) unsigned NOT NULL COMMENT '订单ID',
  `member_id` int(11) unsigned NOT NULL COMMENT '会员用户名',
  `status` tinyint(1) NOT NULL COMMENT '支付状态 0:未支付;1:准备中;2:支付成功;3:已付款至担保方;4:支付失败;5处理异常;6非法参数;7:超时;',
  `pay_name` varchar(100) NOT NULL COMMENT '支付名称  alipay 银联 财付通 等',
  `pay_type` tinyint(1) unsigned NOT NULL COMMENT '支付类型 0:在线支付; 1:线下支付 2:预存款支付; ',
  `t_payed` int(10) unsigned NOT NULL COMMENT '支付完成时间',
  `op_id` mediumint(9) unsigned NOT NULL COMMENT '操作员',
  `payment_bn` varchar(32) NOT NULL COMMENT '支付单唯一编号 暂时不适用，保留字段',
  `account` varchar(50) NOT NULL COMMENT '收款账号',
  `bank` varchar(50) NOT NULL COMMENT '收款银行',
  `pay_account` varchar(50) NOT NULL COMMENT '支付账户',
  `currency` varchar(10) NOT NULL COMMENT '货币',
  `paycost` decimal(20,3) unsigned NOT NULL DEFAULT '0.000' COMMENT '支付网关费用',
  `pay_app_id` varchar(100) NOT NULL COMMENT '支付方式名称',
  `pay_ver` varchar(50) NOT NULL COMMENT '支付版本号',
  `ip` varchar(20) DEFAULT NULL COMMENT 'IP地址',
  `ip_area` varchar(255) DEFAULT NULL COMMENT 'IP地址所在地区',
  `t_begin` int(10) unsigned NOT NULL COMMENT '支付开始时间',
  `t_confirm` int(10) unsigned NOT NULL COMMENT '支付确认时间',
  `memo` longtext COMMENT '支付注释',
  `return_url` varchar(100) NOT NULL COMMENT '支付返回地址',
  `trade_no` varchar(30) NOT NULL COMMENT '支付单交易编号',
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否禁用',
  `thirdparty_account` varchar(50) NOT NULL COMMENT '第三方支付账户',
  `username` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `Index_2` (`order_id`),
  KEY `Index_3` (`t_payed`),
  KEY `Index_4` (`status`),
  KEY `Index_5` (`status`,`t_payed`,`money`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='收款单';

-- 数据导出被取消选择。
-- 导出  表 yiicms.tk_order_pmt 结构
CREATE TABLE IF NOT EXISTS `tk_order_pmt` (
  `pmt_id` int(8) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `order_id` bigint(20) unsigned NOT NULL COMMENT '订单号',
  `product_id` mediumint(8) unsigned NOT NULL COMMENT '产品id',
  `pmt_type` enum('order','goods','coupon') NOT NULL DEFAULT 'goods' COMMENT '优惠类型',
  `pmt_amount` decimal(20,3) NOT NULL DEFAULT '0.000' COMMENT '优惠金额',
  `pmt_tag` longtext COMMENT '优惠标签',
  `pmt_memo` longtext COMMENT '备注',
  `pmt_describe` longtext,
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品id',
  PRIMARY KEY (`pmt_id`) USING BTREE,
  KEY `Index_2` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单优惠表';

-- 数据导出被取消选择。
-- 导出  表 yiicms.tk_order_refunds 结构
CREATE TABLE IF NOT EXISTS `tk_order_refunds` (
  `refund_id` bigint(20) unsigned NOT NULL COMMENT '维权单号',
  `order_id` bigint(20) unsigned NOT NULL COMMENT '订单号',
  `member_id` int(11) unsigned NOT NULL COMMENT '用户ID',
  `logi_id` mediumint(8) unsigned NOT NULL COMMENT '物流公司ID',
  `logi_name` varchar(100) NOT NULL COMMENT '物流公司名称',
  `logi_no` varchar(50) NOT NULL COMMENT '物流单号',
  `ship_name` varchar(50) NOT NULL COMMENT '收货人姓名',
  `ship_area` varchar(255) NOT NULL COMMENT '收货人地区',
  `ship_addr` text NOT NULL COMMENT '收货人地址',
  `ship_zip` varchar(20) NOT NULL COMMENT '收货人邮编',
  `ship_tel` varchar(50) NOT NULL COMMENT '收货人电话',
  `ship_mobile` varchar(50) NOT NULL COMMENT '收货人手机',
  `ship_email` varchar(100) NOT NULL COMMENT '收货人Email',
  `op_id` mediumint(4) unsigned NOT NULL COMMENT '操作者',
  `status` tinyint(2) unsigned NOT NULL COMMENT '当是退货换货时有多种状态,其余只有两种状态',
  `order_item_id` int(10) unsigned DEFAULT '0' COMMENT '维权所对应的子单',
  `ip` varchar(50) DEFAULT NULL,
  `ip_area` varchar(500) DEFAULT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT '0' COMMENT '失效',
  `username` varchar(200) NOT NULL COMMENT '用户名',
  `refunds_type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '维权类型 1:退款 2:退货 3:换货 4:维修',
  `dateline` int(10) unsigned NOT NULL,
  `refunds_money` decimal(20,3) DEFAULT NULL COMMENT '退款金额',
  `op_name` varchar(50) DEFAULT NULL,
  `op_time` int(10) unsigned DEFAULT '0',
  `ship_province` varchar(255) DEFAULT NULL,
  `ship_city` varchar(255) DEFAULT NULL,
  `ship_dist` varchar(255) DEFAULT NULL,
  `ship_community` varchar(255) DEFAULT NULL,
  `finance_bank` varchar(100) DEFAULT NULL COMMENT '银行或第三方支付公司名称',
  `finance_account` varchar(100) DEFAULT NULL COMMENT '汇款帐号',
  `finance_trade_no` varchar(100) DEFAULT NULL COMMENT '外疗汇款流水单号',
  `finance_money` decimal(18,3) DEFAULT NULL COMMENT '汇款金额',
  `finance_remark` varchar(1000) DEFAULT NULL COMMENT '财务备注',
  `finance_point` int(10) DEFAULT '0' COMMENT '退还积分',
  `refunds_point` int(11) DEFAULT '0' COMMENT '所需要退还积分',
  PRIMARY KEY (`refund_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='退货单';

-- 数据导出被取消选择。
-- 导出  表 yiicms.tk_order_remark 结构
CREATE TABLE IF NOT EXISTS `tk_order_remark` (
  `remark_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `op_id` mediumint(8) unsigned DEFAULT NULL COMMENT '操作者id',
  `op_name` varchar(50) DEFAULT NULL COMMENT '操作者名称',
  `order_id` bigint(20) unsigned DEFAULT NULL COMMENT '订单号',
  `dateline` int(10) unsigned NOT NULL COMMENT '时间',
  `ip` varchar(50) DEFAULT NULL COMMENT 'ip地址',
  `ip_area` varchar(45) DEFAULT NULL COMMENT 'ip地址所在地区',
  `remark` longtext COMMENT '备注内容',
  PRIMARY KEY (`remark_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单标注表';

-- 数据导出被取消选择。
-- 导出  表 yiicms.tk_order_selllogs 结构
CREATE TABLE IF NOT EXISTS `tk_order_selllogs` (
  `log_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `member_id` mediumint(8) unsigned DEFAULT '0' COMMENT '用户id',
  `order_id` bigint(20) unsigned DEFAULT NULL COMMENT '订单号',
  `username` varchar(50) DEFAULT NULL COMMENT '用户名',
  `price` decimal(20,3) DEFAULT '0.000' COMMENT '价格',
  `product_id` mediumint(8) unsigned DEFAULT NULL COMMENT '子产品id',
  `goods_id` mediumint(8) unsigned DEFAULT NULL COMMENT '商品id',
  `name` varchar(500) DEFAULT NULL COMMENT '名称',
  `sku` varchar(500) DEFAULT NULL COMMENT 'sku规格名称',
  `nums` mediumint(8) unsigned DEFAULT '0' COMMENT '数量',
  `dateline` int(10) unsigned DEFAULT NULL COMMENT '时间',
  PRIMARY KEY (`log_id`),
  KEY `Index_2` (`goods_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='销售记录表';

-- 数据导出被取消选择。
-- 导出  表 yiicms.tk_order_tag 结构
CREATE TABLE IF NOT EXISTS `tk_order_tag` (
  `tag_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `tag_name` varchar(20) NOT NULL COMMENT '标签名',
  `tag_abbr` varchar(150) DEFAULT NULL COMMENT '标签备注',
  `tag_bgcolor` varchar(7) DEFAULT NULL COMMENT '背景颜色',
  `tag_fgcolor` varchar(7) DEFAULT NULL COMMENT '字体颜色',
  `rel_count` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `displayorder` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否启用',
  PRIMARY KEY (`tag_id`),
  KEY `ind_name` (`tag_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单标签表';

-- 数据导出被取消选择。
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
