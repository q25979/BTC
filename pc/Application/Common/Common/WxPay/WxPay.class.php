<?php
/**
 * 功能：微信支付类
 * 作者：@671
 * 时间：2018年3月7日17:55:09
 */
namespace Common\WxPay;

require_once "UnifiedOrder.class.php";  // 统一下单
require_once "WxWithdraw.class.php";    // 微信提现
require_once "CheckOrder.class.php";    // 订单查询

class WxPay {
    public $appid;         // 微信公众号appid
    public $mch_id;        // 商户号
    public $key;           // 商户key

    public function __construct() {
        $this->appid = WX_APPID;
        $this->mch_id = "1454868302";
        $this->key = "xinyanchinalaijialiang0123456789";
    }
}