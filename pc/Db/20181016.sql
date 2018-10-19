/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : btn

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-10-16 15:34:11
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for btc_admin
-- ----------------------------
DROP TABLE IF EXISTS `btc_admin`;
CREATE TABLE `btc_admin` (
  `admin_id` varchar(32) NOT NULL COMMENT '后台管理id',
  `user_name` varchar(16) NOT NULL COMMENT '管理员账号名',
  `pass_word` varchar(32) NOT NULL DEFAULT '' COMMENT '管理员密码',
  `login_ip` varchar(16) DEFAULT NULL COMMENT '最后登录的IP',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-正常使用 -1-封号',
  `end_time` varchar(10) DEFAULT NULL COMMENT '最后登录的时间',
  `identity` tinyint(1) NOT NULL DEFAULT '2',
  `create_time` varchar(10) DEFAULT NULL COMMENT '创建时间',
  `is_deleted` tinyint(1) DEFAULT '0' COMMENT '是否删除 0-未删除 1 -已删除',
  `delete_time` varchar(10) DEFAULT NULL COMMENT '删除时间',
  `update_time` varchar(10) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`admin_id`,`user_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='后台管理表';

-- ----------------------------
-- Table structure for btc_authentication
-- ----------------------------
DROP TABLE IF EXISTS `btc_authentication`;
CREATE TABLE `btc_authentication` (
  `authentication_id` varchar(32) NOT NULL COMMENT '认证ID',
  `user_id` varchar(32) NOT NULL COMMENT '用户ID',
  `f_status_url` varchar(255) NOT NULL COMMENT '正面身份证图片的url',
  `r_status_url` varchar(255) NOT NULL COMMENT '身份证反面的url',
  `hand_status_url` varchar(255) NOT NULL COMMENT '手持身份证的URL',
  `status` varchar(2) NOT NULL DEFAULT '0' COMMENT '0-待审核 1-审核通过 -1 审核不通过',
  `delete_time` varchar(12) CHARACTER SET latin1 DEFAULT NULL COMMENT '删除时间',
  `update_time` varchar(12) CHARACTER SET latin1 DEFAULT NULL COMMENT '更新时间',
  `create_time` varchar(12) CHARACTER SET latin1 DEFAULT NULL COMMENT '创建时间',
  `is_deleted` varchar(1) CHARACTER SET latin1 NOT NULL DEFAULT '0' COMMENT '是否删除0-未删除 1-已删除',
  PRIMARY KEY (`authentication_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='认证审核表';

-- ----------------------------
-- Table structure for btc_bank
-- ----------------------------
DROP TABLE IF EXISTS `btc_bank`;
CREATE TABLE `btc_bank` (
  `bank_id` varchar(32) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `bank_type` varchar(1) NOT NULL COMMENT '1主银行2.银行分行',
  `bank_parent` varchar(32) NOT NULL DEFAULT '0' COMMENT '父类ID',
  `is_deleted` varchar(1) NOT NULL DEFAULT '0' COMMENT '是否删除',
  `delete_time` varchar(12) DEFAULT NULL COMMENT '删除时间',
  `update_time` varchar(12) DEFAULT NULL COMMENT '更新时间',
  `create_time` varchar(12) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`bank_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for btc_bulletin
-- ----------------------------
DROP TABLE IF EXISTS `btc_bulletin`;
CREATE TABLE `btc_bulletin` (
  `bulletin_id` varchar(32) NOT NULL COMMENT '公告ID',
  `bulletin_title_i18n` varchar(32) NOT NULL COMMENT '公告标题',
  `status` varchar(1) NOT NULL DEFAULT '0' COMMENT '发布状态0-未发布 1-已发布',
  `bulletin_content_i18n` varchar(32) NOT NULL COMMENT '公告内容',
  `bulletin_issue_time` varchar(12) DEFAULT NULL COMMENT '公告发布时间',
  `delete_time` varchar(12) CHARACTER SET latin1 DEFAULT NULL COMMENT '删除时间',
  `update_time` varchar(12) CHARACTER SET latin1 DEFAULT NULL COMMENT '更新时间',
  `create_time` varchar(12) CHARACTER SET latin1 DEFAULT NULL COMMENT '创建时间',
  `is_deleted` varchar(1) CHARACTER SET latin1 NOT NULL DEFAULT '0' COMMENT '是否删除0-未删除 1-已删除',
  PRIMARY KEY (`bulletin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='公告表';

-- ----------------------------
-- Table structure for btc_common_problem
-- ----------------------------
DROP TABLE IF EXISTS `btc_common_problem`;
CREATE TABLE `btc_common_problem` (
  `common_problem_id` varchar(32) NOT NULL COMMENT '常见问题ID',
  `title_i18n_id` varchar(32) DEFAULT NULL COMMENT '标题题目',
  `content_i18n_id` varchar(32) DEFAULT NULL COMMENT '问题内容',
  `type` tinyint(1) DEFAULT '1' COMMENT '查看constant.php文件',
  `delete_time` varchar(12) DEFAULT NULL COMMENT '删除时间',
  `update_time` varchar(12) DEFAULT NULL COMMENT '更新时间',
  `create_time` varchar(12) DEFAULT NULL COMMENT '创建时间',
  `is_deleted` varchar(1) NOT NULL DEFAULT '0' COMMENT '是否删除0-未删除 1-已删除',
  PRIMARY KEY (`common_problem_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='常见问题表';

-- ----------------------------
-- Table structure for btc_currency_value
-- ----------------------------
DROP TABLE IF EXISTS `btc_currency_value`;
CREATE TABLE `btc_currency_value` (
  `id` varchar(32) NOT NULL,
  `btc_value_twd` decimal(50,0) NOT NULL COMMENT '比特币对新台币的单价',
  `btc_value_hkd` decimal(50,0) NOT NULL COMMENT '比特币对港币的单价',
  `btc_value_usd` decimal(50,0) NOT NULL COMMENT '比特币对美元的单价',
  `eth_value_twd` decimal(50,0) NOT NULL COMMENT '以太币对新台币的单价',
  `eth_value_hkd` decimal(50,0) NOT NULL COMMENT '以太币对港币的单价',
  `eth_value_usd` decimal(50,0) NOT NULL COMMENT '以太币对美元的单价',
  `etc_float_max` varchar(10) NOT NULL COMMENT '以太币浮动值',
  `btc_float_max` varchar(10) NOT NULL COMMENT '比特币浮动值',
  `etc_float_min` varchar(10) NOT NULL COMMENT '以太币浮动最小值',
  `btc_float_min` varchar(10) NOT NULL COMMENT '比特币浮动最小值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='货币价值表';

-- ----------------------------
-- Table structure for btc_exchange
-- ----------------------------
DROP TABLE IF EXISTS `btc_exchange`;
CREATE TABLE `btc_exchange` (
  `id` int(2) NOT NULL,
  `usd` float(32,4) DEFAULT NULL COMMENT '美金',
  `twd` float(32,4) DEFAULT NULL COMMENT '新台币',
  `hkd` float(32,4) DEFAULT NULL COMMENT '港币',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='汇率设置';

-- ----------------------------
-- Table structure for btc_home_info
-- ----------------------------
DROP TABLE IF EXISTS `btc_home_info`;
CREATE TABLE `btc_home_info` (
  `id` varchar(32) NOT NULL,
  `background_url` varchar(255) NOT NULL COMMENT '首页图片的URL',
  `logo_url` varchar(255) NOT NULL COMMENT '首页图标的URL',
  `name` varchar(255) NOT NULL COMMENT '网站名字',
  `company_tel` varchar(18) NOT NULL COMMENT '公司电话',
  `i18n_id` varchar(50) NOT NULL COMMENT '公司营业时间，用文字描述',
  `company_email` varchar(50) NOT NULL COMMENT '公司邮箱',
  `bulletin_status` varchar(1) NOT NULL COMMENT '0-公告浮动1-公告隐藏',
  `service_status` varchar(1) NOT NULL COMMENT '0-客服浮动1-客服隐藏',
  `float_status` varchar(1) NOT NULL DEFAULT '0' COMMENT '1-开启自动跳动 0-关闭自动跳动',
  `email_type` varchar(1) DEFAULT NULL COMMENT '1-QQ邮箱 2-163邮箱3-雅虎邮箱',
  `email_account` varchar(50) DEFAULT NULL COMMENT '邮箱账号',
  `email_password` varchar(50) DEFAULT NULL COMMENT '邮箱密码',
  `buy_float` varchar(10) NOT NULL COMMENT '买入的浮动设置',
  `sell_float` varchar(10) NOT NULL COMMENT '卖出的浮动',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='界面图片信息表';

-- ----------------------------
-- Table structure for btc_i18n
-- ----------------------------
DROP TABLE IF EXISTS `btc_i18n`;
CREATE TABLE `btc_i18n` (
  `i18n_id` varchar(32) NOT NULL COMMENT '国际化ID',
  `en_content` text COMMENT '英文',
  `tw_content` text COMMENT '繁体',
  `deleted_time` varchar(11) DEFAULT NULL COMMENT '删除时间',
  `update_time` varchar(11) DEFAULT NULL,
  `create_time` varchar(11) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0' COMMENT '0-正常 1-删除',
  PRIMARY KEY (`i18n_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='国际化信息表';

-- ----------------------------
-- Table structure for btc_information
-- ----------------------------
DROP TABLE IF EXISTS `btc_information`;
CREATE TABLE `btc_information` (
  `information_id` varchar(32) NOT NULL COMMENT '消息ID',
  `maincoin_id` varchar(50) NOT NULL COMMENT '发送对象',
  `title_i18n_id` varchar(50) NOT NULL COMMENT '标题',
  `content_i18n_id` text NOT NULL COMMENT '发送内容',
  `delete_time` varchar(12) CHARACTER SET latin1 DEFAULT NULL COMMENT '删除时间',
  `update_time` varchar(12) CHARACTER SET latin1 DEFAULT NULL COMMENT '更新时间',
  `create_time` varchar(12) CHARACTER SET latin1 DEFAULT NULL COMMENT '创建时间',
  `is_deleted` varchar(1) CHARACTER SET latin1 NOT NULL DEFAULT '0' COMMENT '是否删除0-未删除 1-已删除',
  PRIMARY KEY (`information_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='发送消息表';

-- ----------------------------
-- Table structure for btc_message
-- ----------------------------
DROP TABLE IF EXISTS `btc_message`;
CREATE TABLE `btc_message` (
  `msg_id` varchar(32) NOT NULL COMMENT '信息表id',
  `appid` varchar(50) NOT NULL COMMENT 'AccessKeyID',
  `appkey` varchar(50) NOT NULL COMMENT 'AccessKeySecret',
  `sign` varchar(255) NOT NULL COMMENT '短信签名',
  `template_id` varchar(255) NOT NULL COMMENT '模板id',
  `status` int(5) DEFAULT NULL COMMENT '状态 0-开启 1-关闭',
  `update_time` varchar(255) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='短信验证表';

-- ----------------------------
-- Table structure for btc_order_info
-- ----------------------------
DROP TABLE IF EXISTS `btc_order_info`;
CREATE TABLE `btc_order_info` (
  `order_id` varchar(32) NOT NULL COMMENT '订单ID',
  `user_id` varchar(32) NOT NULL COMMENT '用户ID',
  `system_order` varchar(32) NOT NULL COMMENT '订单号（交易ID）',
  `number` decimal(50,4) NOT NULL DEFAULT '0.0000' COMMENT '数量',
  `price` varchar(50) NOT NULL COMMENT '价格',
  `money_currency_type` varchar(1) NOT NULL COMMENT '货币类型 1-新台币2-港币3-美元',
  `status` tinyint(1) NOT NULL COMMENT '订单状态 0-已提交 1 -进行中 2-已完成 -1-已取消',
  `order_type` varchar(1) NOT NULL COMMENT '订单类型0-买入1-卖出',
  `payment_type` varchar(1) DEFAULT NULL COMMENT '是购买订单时需填入1-银行转账2-余额付款',
  `unit_price` float(50,4) NOT NULL COMMENT '单价',
  `currency_type` varchar(1) NOT NULL COMMENT '币种类型1-BTC 2-ETC',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `create_time` varchar(10) NOT NULL COMMENT '创建时间',
  `is_deleted` tinyint(1) DEFAULT '0' COMMENT '是否删除 0-未删除 1 -已删除',
  `delete_time` varchar(10) DEFAULT NULL COMMENT '删除时间',
  `update_time` varchar(10) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单信息表';

-- ----------------------------
-- Table structure for btc_problem
-- ----------------------------
DROP TABLE IF EXISTS `btc_problem`;
CREATE TABLE `btc_problem` (
  `problem_id` varchar(32) NOT NULL COMMENT '问题ID',
  `system_order` varchar(32) DEFAULT NULL COMMENT '交易ID（选填）',
  `email` varchar(30) DEFAULT NULL COMMENT '邮箱',
  `name` varchar(50) DEFAULT NULL COMMENT '姓名',
  `topic` varchar(50) DEFAULT NULL COMMENT '问题题目',
  `content` text COMMENT '问题内容',
  `delete_time` varchar(12) DEFAULT NULL COMMENT '删除时间',
  `update_time` varchar(12) DEFAULT NULL COMMENT '更新时间',
  `create_time` varchar(12) DEFAULT NULL COMMENT '创建时间',
  `is_deleted` varchar(1) NOT NULL DEFAULT '0' COMMENT '是否删除0-未删除 1-已删除',
  PRIMARY KEY (`problem_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='问题表';

-- ----------------------------
-- Table structure for btc_problem_attach
-- ----------------------------
DROP TABLE IF EXISTS `btc_problem_attach`;
CREATE TABLE `btc_problem_attach` (
  `attach_id` varchar(32) NOT NULL COMMENT '问题附件ID',
  `problem_id` varchar(32) NOT NULL COMMENT '附件ID',
  `file_name` varchar(200) DEFAULT NULL COMMENT '文件名',
  `file_address` varchar(200) NOT NULL COMMENT '文件地址',
  `create_time` varchar(10) DEFAULT NULL COMMENT '创建时间',
  `is_deleted` varchar(1) NOT NULL DEFAULT '0' COMMENT '是否删除 0-未删除 1 -已删除',
  `delete_time` varchar(10) DEFAULT NULL COMMENT '删除时间',
  `update_time` varchar(10) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`attach_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='问题附件表';

-- ----------------------------
-- Table structure for btc_send
-- ----------------------------
DROP TABLE IF EXISTS `btc_send`;
CREATE TABLE `btc_send` (
  `send_id` varchar(32) NOT NULL COMMENT '发送ID',
  `user_id` varchar(32) NOT NULL COMMENT '用户id',
  `maincoin_id` varchar(8) NOT NULL COMMENT '接受方的ID',
  `send_address` varchar(50) NOT NULL COMMENT '发送地址',
  `number` decimal(50,4) NOT NULL DEFAULT '0.0000' COMMENT '发送数量（最多发送数是小数点后8位）',
  `send_cost` decimal(50,4) DEFAULT '0.0000' COMMENT '发送所需费用',
  `leave_words` text COMMENT '留言',
  `currency_type` varchar(1) NOT NULL COMMENT '发送币种类型 1-BTC 2-ETH',
  `img_url` varchar(100) DEFAULT NULL COMMENT '客户上传图片的URL',
  `is_deleted` varchar(1) NOT NULL DEFAULT '0' COMMENT '是否删除 0-未删除 1-已删除',
  `delete_time` varchar(12) DEFAULT NULL COMMENT '删除时间',
  `update_time` varchar(12) DEFAULT NULL COMMENT '更新时间',
  `create_time` varchar(12) DEFAULT NULL COMMENT '创建时间',
  `status` varchar(2) NOT NULL DEFAULT '0' COMMENT '0-已提交  -1-失败  1-进行中2-已完成',
  `remark` varchar(255) DEFAULT NULL COMMENT '审核意见',
  PRIMARY KEY (`send_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='发送币种表';

-- ----------------------------
-- Table structure for btc_service
-- ----------------------------
DROP TABLE IF EXISTS `btc_service`;
CREATE TABLE `btc_service` (
  `service_id` varchar(32) NOT NULL COMMENT '客服ID',
  `name` text NOT NULL COMMENT '称呼',
  `tel` text COMMENT '联系方式',
  `status` varchar(1) DEFAULT '0' COMMENT '0-浮动1-隐藏',
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='客服表';

-- ----------------------------
-- Table structure for btc_show_currency_value
-- ----------------------------
DROP TABLE IF EXISTS `btc_show_currency_value`;
CREATE TABLE `btc_show_currency_value` (
  `id` varchar(32) NOT NULL,
  `btc_value_twd` decimal(50,0) NOT NULL COMMENT '比特币对新台币的单价',
  `btc_value_hkd` decimal(50,0) NOT NULL COMMENT '比特币对港币的单价',
  `btc_value_usd` decimal(50,0) NOT NULL COMMENT '比特币对美元的单价',
  `eth_value_twd` decimal(50,0) NOT NULL COMMENT '以太币对新台币的单价',
  `eth_value_hkd` decimal(50,0) NOT NULL COMMENT '以太币对港币的单价',
  `eth_value_usd` decimal(50,0) NOT NULL COMMENT '以太币对美元的单价',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='界面显示货币价值表';

-- ----------------------------
-- Table structure for btc_token
-- ----------------------------
DROP TABLE IF EXISTS `btc_token`;
CREATE TABLE `btc_token` (
  `token` varchar(32) NOT NULL COMMENT 'token',
  PRIMARY KEY (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='token验证表\r\n生成token方式\r\nmd5(base64_encode(base64_encode(''需要验证的邮箱'')))';

-- ----------------------------
-- Table structure for btc_up_order
-- ----------------------------
DROP TABLE IF EXISTS `btc_up_order`;
CREATE TABLE `btc_up_order` (
  `up_order_id` varchar(32) NOT NULL COMMENT '提现订单ID',
  `user_id` varchar(32) NOT NULL COMMENT '用户id',
  `up_price` decimal(50,4) NOT NULL DEFAULT '0.0000' COMMENT '提现金额',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '提现状态 0-审核中，1-提现成功，-1-提现失败',
  `refusal_cause` varchar(255) DEFAULT NULL COMMENT '拒绝提现原因',
  `is_deleted` varchar(1) NOT NULL DEFAULT '0' COMMENT '是否删除 0-未删除 1-已删除',
  `delete_time` varchar(12) DEFAULT NULL COMMENT '删除时间',
  `update_time` varchar(12) DEFAULT NULL COMMENT '更新时间',
  `create_time` varchar(12) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`up_order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='提现订单表';

-- ----------------------------
-- Table structure for btc_user
-- ----------------------------
DROP TABLE IF EXISTS `btc_user`;
CREATE TABLE `btc_user` (
  `user_id` varchar(32) NOT NULL,
  `maincoin_id` varchar(8) DEFAULT NULL COMMENT '随机生成的mciID',
  `user_name` varchar(50) DEFAULT NULL COMMENT '姓名',
  `birthdate` varchar(15) DEFAULT NULL COMMENT '出生年月',
  `certificate_type` varchar(1) DEFAULT NULL COMMENT '证件类型 1-台湾居住证 2-台湾居留证 3-护照',
  `certificate_num` varchar(25) DEFAULT NULL COMMENT '证件号码',
  `tel` varchar(20) DEFAULT NULL COMMENT '手机号码',
  `email` varchar(50) NOT NULL COMMENT '电子邮箱',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `status` varchar(2) NOT NULL DEFAULT '0' COMMENT '状态 0-正常 -1-锁定',
  `login_ip` varchar(32) NOT NULL,
  `register_ip` varchar(32) NOT NULL,
  `is_deleted` varchar(1) NOT NULL DEFAULT '0' COMMENT '是否删除 0-未删除 1-已删除',
  `delete_time` varchar(12) DEFAULT NULL COMMENT '删除时间',
  `update_time` varchar(12) DEFAULT NULL COMMENT '更新时间',
  `create_time` varchar(12) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`user_id`,`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Table structure for btc_user_account
-- ----------------------------
DROP TABLE IF EXISTS `btc_user_account`;
CREATE TABLE `btc_user_account` (
  `account_id` varchar(32) NOT NULL COMMENT '账户ID',
  `user_id` varchar(32) NOT NULL COMMENT '用户id',
  `btc_balance` decimal(50,4) NOT NULL DEFAULT '0.0000' COMMENT '比特币余额',
  `eth_balance` decimal(50,4) NOT NULL DEFAULT '0.0000' COMMENT '以太币余额',
  `balance` varchar(50) NOT NULL DEFAULT '0' COMMENT '余额',
  `status` varchar(2) NOT NULL DEFAULT '0' COMMENT '0-启用 1-停用',
  `freeze_balance` varchar(50) NOT NULL DEFAULT '0' COMMENT '冻结余额',
  `extract_balance` decimal(50,2) NOT NULL DEFAULT '0.00' COMMENT '可提现余额',
  `bank_name` varchar(50) DEFAULT NULL COMMENT '银行名称',
  `bank_num` varchar(30) DEFAULT NULL COMMENT '银行卡号',
  `bank_account` varchar(50) DEFAULT NULL COMMENT '银行账户名(持卡人名字)',
  `bank_branch` varchar(50) DEFAULT NULL COMMENT '银行分行民称',
  `is_deleted` varchar(1) NOT NULL DEFAULT '0' COMMENT '是否删除 0-未删除 1-已删除',
  `delete_time` varchar(12) DEFAULT NULL COMMENT '删除时间',
  `update_time` varchar(12) DEFAULT NULL COMMENT '更新时间',
  `create_time` varchar(12) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='账户表';

-- ----------------------------
-- Table structure for btc_user_attach
-- ----------------------------
DROP TABLE IF EXISTS `btc_user_attach`;
CREATE TABLE `btc_user_attach` (
  `attach_id` varchar(32) NOT NULL COMMENT '用户附件ID',
  `user_id` varchar(32) NOT NULL COMMENT '用户id',
  `file_type` varchar(1) NOT NULL COMMENT '文件类型(1-手持身份证照2-身份证正面3-身份证反面)',
  `file_address` varchar(200) NOT NULL COMMENT '文件地址',
  `create_time` varchar(10) DEFAULT NULL COMMENT '创建时间',
  `is_deleted` varchar(1) NOT NULL DEFAULT '0' COMMENT '是否删除 0-未删除 1 -已删除',
  `delete_time` varchar(10) DEFAULT NULL COMMENT '删除时间',
  `update_time` varchar(10) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`attach_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户附件表';

-- ----------------------------
-- Table structure for btc_user_set
-- ----------------------------
DROP TABLE IF EXISTS `btc_user_set`;
CREATE TABLE `btc_user_set` (
  `seting_id` varchar(32) NOT NULL COMMENT '设置ID',
  `user_id` varchar(32) NOT NULL COMMENT '用户ID',
  `password_hint_one` varchar(255) DEFAULT NULL COMMENT '密码安全问题1',
  `password_hint_two` varchar(255) DEFAULT NULL COMMENT '密码安全问题2',
  `password_hint_three` varchar(255) DEFAULT NULL COMMENT '密码安全问题3',
  `answer_one` varchar(255) DEFAULT NULL COMMENT '问题1的答案',
  `answer_two` varchar(255) DEFAULT NULL COMMENT '问题2的答案',
  `answer_three` varchar(255) DEFAULT NULL COMMENT '问题3的答案',
  `email_login` varchar(1) NOT NULL DEFAULT '1' COMMENT '登录时邮件通知设置0-不通知1-要通知',
  `email_get` varchar(1) NOT NULL DEFAULT '1' COMMENT '发送、接收或支付时，接收邮件通知0-不通知1-要通知',
  `email_buy` varchar(1) NOT NULL DEFAULT '1' COMMENT '买入时邮件通知0-不通知1-已通知',
  `create_time` varchar(10) DEFAULT NULL COMMENT '创建时间',
  `is_deleted` varchar(1) NOT NULL DEFAULT '0' COMMENT '是否删除 0-未删除 1 -已删除',
  `delete_time` varchar(10) DEFAULT NULL COMMENT '删除时间',
  `update_time` varchar(10) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`seting_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户设置表';

-- ----------------------------
-- Table structure for btc_user_wallet_address
-- ----------------------------
DROP TABLE IF EXISTS `btc_user_wallet_address`;
CREATE TABLE `btc_user_wallet_address` (
  `user_wallet_address_id` varchar(32) NOT NULL,
  `user_id` varchar(32) NOT NULL COMMENT '用户id',
  `wallet_address_id` varchar(32) NOT NULL COMMENT '钱包地址id',
  `label` varchar(32) DEFAULT NULL COMMENT '标签',
  `create_time` varchar(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`user_wallet_address_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户钱包地址表';

-- ----------------------------
-- Table structure for btc_wallet_address
-- ----------------------------
DROP TABLE IF EXISTS `btc_wallet_address`;
CREATE TABLE `btc_wallet_address` (
  `wallet_address_id` varchar(32) NOT NULL COMMENT '钱包地址ID',
  `type` varchar(1) NOT NULL COMMENT '币种类型',
  `address` varchar(50) NOT NULL COMMENT '币种地址',
  `address_url` varchar(255) DEFAULT NULL,
  `is_deleted` varchar(1) DEFAULT '0' COMMENT '是否删除 0-未删除 1-已删除',
  `delete_time` varchar(12) DEFAULT NULL COMMENT '删除时间',
  `update_time` varchar(12) DEFAULT NULL COMMENT '更新时间',
  `create_time` varchar(12) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`wallet_address_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='钱包地址表';
