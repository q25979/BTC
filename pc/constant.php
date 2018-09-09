<?php
/**
 * 定义常量
 * User: @671
 * Date: 2018/4/8
 * Time: 17:43
 */

define('VERIFY_STR', 'oDY3UMuTPUmP4Yq5HWNKztJgjOzv69C1');   // 验证字符串
define('LIMIT', 10);     									// 分页

// 删除
define('IS_NOT_DELETED', 0);    	// 设置删除条件：未删除
define('IS_DELETED', 1); 	        // 设置删除条件：已删除

//交易货币币种
define('TWD', 1);                   // 设置货币：新台币
define('HKD', 2);                   // 设置货币：港币
define('USD', 3);                   // 设置货币：美元

// 订单状态
define('ORDER_STATUS_SUBMIT', 0);      // 设置订单状态：已提交
define('ORDER_STATUS_UNDERWAY', 1);    // 设置订单状态：进行中
define('ORDER_STATUS_FINISH', 2);      // 设置订单状态：已完成
define('ORDER_STATUS_CANCEL', -1);     // 设置订单状态：已取消

// 订单类型
define('ORDER_TYPE_BUY', 0);            // 设置订单类型：买入
define('ORDER_TYPE_SALE', 1);           // 设置订单类型：卖出

// 订单付款类型
define('PAYMENT_TYPE_BANK', 1);         // 设置付款类型：银行转账
define('PAYMENT_TYPE_BALANCE', 2);      // 设置付款类型：余额付款

//认证状态
define('ATTEST_STATUS_AUTID', 0);        // 设置认证状态：待审核
define('ATTEST_STATUS_ADOPT', 1);		 // 设置认证状态：通过
define('ATTEST_STATUS_NOTADOPT', -1);    // 设置认证状态：未通过

//证件类型
define('CERTIFICATE_RPT', 1);        	// 证件类型：台湾居住证
define('CERTIFICATE_RPC', 2);			// 证件类型：台湾居留证
define('CERTIFICATE_PASSPORT', 3);      //  证件类型：护照

// 后台状态
define('ADMIN_STATUS_ENABLE', 0);       // 设置后台状态：启用
define('ADMIN_STATUS_DISABLE', -1);     // 设置后台状态：封号

// 反馈状态
define('FEEDBACK_STATUS_UNREAD', 0);    // 设置反馈状态：未读
define('FEEDBACK_STATUS_READ', 1);      // 设置反馈状态：已读

// 商品
define('SHOP_IS_HOT_NOT', 0);           // 热售推荐：正常
define('SHOP_IS_HOT_YES', 1);           // 热售推荐：热售
define('SHOP_STATUS_PUTAWAY', 0);       // 设置商品状态：上架
define('SHOP_STATUS_SOLD_OUT', 1);      // 设置商品状态：下架

//发布
define('IS_NOT_BULLETIN', 0);               // 设置商品状态：未发布
define('IS_BULLETIN', 1);       	        // 设置商品状态：发布
   
// 用户状态
define('USER_STATUS_ENABLE', 0);            // 设置用户状态：正常
define('USER_STATUS_LOCK', -1);             // 设置用户状态：锁定

// 账户状态
define('ACCOUNT_STATUS_ENABLE', 0);         // 设置账户状态：正常(恢复)
define('ACCOUNT_STATUS_LOCK', -1);          // 设置账户状态：冻结

// 提现状态
define('WITHDRAW_STATUS_FIAL', -1);         // 提现状态：失败
define('WITHDRAW_STATUS_ING', 0);           // 提现状态：审核中
define('WITHDRAW_STATUS_SUCCESS', 1);       // 提现状态：成功

// 退款方式
define('RETURN_GOODS_TYPE_WECHAT', 0);  // 退款方式：微信
define('RETURN_GOODS_TYPE_BANK', 1);    // 退款方式：银行卡

// 退款状态
define('RETURN_GOODS_STATUS_ERROR', -1);    // 退款状态：失败
define('RETURN_GOODS_STATUS_SUCCESS', 0);   // 退款状态：成功
define('RETURN_GOODS_STATUS_ING', 1);       // 退款状态：退款中
define('RETURN_GOODS_STATUS_REJECT', 2);    // 退款状态：拒绝

// 常见问题类型
define('PROBLEM_TYPE_SEND_REC', 1);     // 常见问题类型：发送与接收
define('PROBLEM_TYPE_BUY_SELL', 2);     // 常见问题类型：购买与出售
define('PROBLEM_TYPE_IS_MERCHANT', 3);  // 常见问题类型：成为特约商家
define('PROBLEM_TYPE_ABOUT', 4);        // 常见问题类型：关于
define('PROBLEM_TYPE_SECURITY', 5);     // 常见问题类型：账户安全与实名审核
define('PROBLEM_TYPE_NOT_CHEAT', 6);    // 常见问题类型：反诈骗及处理流程

// 钱包地址
define('WALLET_MAX_NUMBER', 10);        // 钱包地址：钱包最大数量

// 货币类型
define('CURRENCY_TYPE_BTC', 1);         // 货币类型：比特币
define('CURRENCY_TYPE_ETN', 2);         // 货币类型：以太币

// 邮箱类型
define('EMAIL_TYPE_QQ', 1);         // QQ邮箱
define('EMAIL_TYPE_163', 2);        // 163邮箱
define('EMAIL_TYPE_YAHOO', 3);      // 雅虎邮箱

// ID
define('HOME_INFO_ID', '10000000000000000000000000000000');             // home_info_id
define('CURRENCY_VALUE_ID', '10000000000000000000000000000000');        // currency_value_id
define('SHOW_CURRENCY_VALUE_ID', '10000000000000000000000000000000');   // currency_value_id

// 发送状态
define('SEND_STATUS_SUBMIT', 0);         // 已提交
define('SEND_STATUS_LOSE', -1);          // 失败
define('SEND_STATUS_UNDERWAY', 1);       // 进行中
define('SEND_STATUS_SUCCESS', 2);        // 已完成

// 浮动设置
define('FLOAT_STATUS_ON', 0);           // 浮动开启
define('FLOAT_STATUS_OFF', 1);          // 浮动关闭

// 公告设置
define('BULLETIN_STATUS_ON', 0);        // 公告开启
define('BULLETIN_STATUS_OFF', 1);       // 公告关闭

// 公告发布状态
define('BULLETIN_ISSUE_STATUS_ON', 0);        // 公告未发布
define('BULLETIN_ISSUE_STATUS_OFF', 1);       // 公告已发布

// 客服设置
define('SERVICE_STATUS_ON', 0);         // 客服开启
define('SERVICE_STATUS_OFF', 1);        // 客服关闭

// 钱包地址币种种类
define('BTC', 1);         // 客服开启
define('ETH', 2);         // 客服关闭

// 钱包地址
define('WALLET_TYPE_ETH_ID', '10000000000000000000000000000010');   // 以太币id

// 用户发送邮件设置
define('USER_SET_EMAIL_LOGIN_NO', 0);   	// 登录邮件不通知
define('USER_SET_EMAIL_LOGIN_YES', 1);   	// 登录邮件通知
define('USER_SET_EMAIL_BUY_NO', 0);   		// 买入卖出邮件不通知
define('USER_SET_EMAIL_BUY_YES', 1);   		// 买入卖出邮件通知
define('USER_SET_EMAIL_GET_NO', 0);   		// 发送接收等邮件不通知
define('USER_SET_EMAIL_GET_YES', 1);   		// 发送接收等邮件通知

// 银行类型
define('BANK_TYPE_PARENT', 1);   			// 主银行
define('BANK_TYPE_SON', 2);   	  			// 子银行
