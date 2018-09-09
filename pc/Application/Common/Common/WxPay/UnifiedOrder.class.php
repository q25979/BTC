<?php
/**
 * 作者：@671
 * 时间：2018年3月7日19:34:08
 * 功能：微信支付统一下单
 */

use Common\WxPay\WxPay;
use Common\Common;

class UnifiedOrder extends WxPay {
    protected $total;       // 下单总金额
    protected $body;        // 商品描述
    protected $notify_url;  // 通知地址
    protected $trade_type;  // 支付类型
    protected $openid;      // 微信的用户openid
    protected $attach;      // 附加数据

    public function __construct($total, $body, $notify_url, $trade_type = "JSAPI", $openid = "", $attach = "") {
        parent::__construct();  // 继承WxPay配置的信息

        $this->total = $total;              // 设置下单总金额
        $this->body = $body;                // 设置商品描述
        $this->notify_url = $notify_url;    // 设置通知地址
        $this->trade_type = $trade_type;    // 设置支付类型,JSAPI 公众号支付,NATIVE 扫码支付,APP APP支付,默认JSAPI
        $this->openid = $openid;            // 设置微信用户openid
        $this->attach = $attach;            // 设置附加数据
    }

    /**
     * 生成统一订单
     *
     * @return json 返回json数据
     */
    public function build() {
        $data = $this->config();

        $url = "https://api.mch.weixin.qq.com/pay/unifiedorder";
        $xmlData = $this->setXmlData($data);

        $info = Request::xmlPost($url, $xmlData);
        $result = $info;
        $result['out_trade_no'] = $data['out_trade_no'];

        return $result;
    }

    /**
     * 所需参数配置
     *
     * @return json 所需的参数
     */
    private function config() {
        $data['appid'] = $this->appid;                  // 微信appid
        $data['attach'] = $this->attach;                // 附加数据
        $data['body'] = $this->body;                    // 商品描述
        $data['mch_id'] = $this->mch_id;                // 商户号
        $data['nonce_str'] = \Common::nonceStr(32);     // 随机数
        $data['notify_url'] = $this->notify_url;        // 设置通知地址
        $data['openid'] = $this->openid;                // 用户标识
        $data['out_trade_no'] = \Common::createOrder(); // 商户订单号
        $data['spbill_create_ip'] = \Common::getIP();   // 获取IP
        $data['total_fee'] = $this->total * 100;        // 设置金额，单位分所以*100变成元
        $data['trade_type'] = $this->trade_type;        // 设置支付类型，JSAPI 公众号支付,NATIVE 扫码支付,APP APP支付,默认JSAPI

        return $data;
    }

    /**
     * 设置需要发送的xml数据
     *
     * $data json 需要发送的参数
     * @return string xml数据
     */
    private function setXmlData($data) {
        $sign = $this->setSign($data);   // 获取签名

        $xml  = "<xml>";
        $xml .= "<appid>$data[appid]</appid>";
        $xml .= "<attach>$data[attach]</attach>";
        $xml .= "<body>$data[body]</body>";
        $xml .= "<mch_id>$data[mch_id]</mch_id>";
        $xml .= "<nonce_str>$data[nonce_str]</nonce_str>";
        $xml .= "<notify_url>$data[notify_url]</notify_url>";

        // 判断openid是否存在
        if (!empty($data['openid'])) {
            $xml .= "<openid>$data[openid]</openid>";
        }

        $xml .= "<out_trade_no>$data[out_trade_no]</out_trade_no>";
        $xml .= "<spbill_create_ip>$data[spbill_create_ip]</spbill_create_ip>";
        $xml .= "<total_fee>$data[total_fee]</total_fee>";
        $xml .= "<trade_type>$data[trade_type]</trade_type>";
        $xml .= "<sign>$sign</sign>";
        $xml .= "</xml>";

        return $xml;
    }

    /**
     * 设置统一下单签名
     *
     * $data json 所需签名的参数
     * @return string 生成签名
     */
    private function setSign($data) {
        // 签名串
        $str = 'appid='. $data['appid'] .'&attach='. $data['attach'] .'&body='. $data['body'] .'&mch_id='. $data['mch_id']
            .'&nonce_str='. $data['nonce_str'] .'&notify_url='. $data['notify_url'];

        // 判断是否需要openid
        if (!empty($data['openid'])) {
            // 表示openid是存在的
            $str =  $str . '&openid='. $data['openid'];
        }

        $str = $str . '&out_trade_no='. $data['out_trade_no'] .'&spbill_create_ip='. $data['spbill_create_ip']
            .'&total_fee='. $data['total_fee'] .'&trade_type='. $data['trade_type'];

        $stringKey = $str . '&key=' . $this->key;
        $sign = strtoupper(md5($stringKey));

        return $sign;
    }
}