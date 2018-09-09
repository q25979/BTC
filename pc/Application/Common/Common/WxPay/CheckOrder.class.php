<?php
/**
 * 作者：@671
 * 时间：2018年3月8日19:44:17
 * 功能：微信查询订单
 */

use Common\WxPay\WxPay;
use Common\Common;

class CheckOrder extends WxPay {
    private $out_trade_no;  // 商户系统订单

    public function __construct($out_trade_no) {
        parent::__construct();

        $this->out_trade_no = $out_trade_no;    // 设置商户系统订单
    }

    /**
     * 微信查询订单
     *
     * @return string 详细：https://pay.weixin.qq.com/wiki/doc/api/native.php?chapter=9_2
     */
    public function build() {
        $data = $this->config();

        $url = "https://api.mch.weixin.qq.com/pay/orderquery";
        $xml = $this->setXmlData($data);

        $info = Request::xmlPost($url, $xml);

        return $info;
    }

    /**
     * 配置查询订单所需参数
     *
     * @return json 配置查询订单所需参数
     */
    private function config() {
        $data['appid'] = $this->appid;                  // 配置微信appid
        $data['mch_id'] = $this->mch_id;                // 配置微信商户号
        $data['nonce_str'] = \Common::nonceStr();       // 配置随机串
        $data['out_trade_no'] = $this->out_trade_no;    // 配置商户系统订单

        return $data;
    }

    /**
     * 设置需要发送的xml数据
     *
     * $data json 需要发送的参数
     * @return string xml数据
     */
    private function setXmlData($data) {
        $sign = $this->sign($data);

        $xml  = "<xml>";
        $xml .= "<appid>$data[appid]</appid>";
        $xml .= "<mch_id>$data[mch_id]</mch_id>";
        $xml .= "<nonce_str>$data[nonce_str]</nonce_str>";
        $xml .= "<out_trade_no>$data[out_trade_no]</out_trade_no>";
        $xml .= "<sign>$sign</sign>";
        $xml .= "</xml>";

        return $xml;
    }

    /**
     * 设置查询订单签名
     *
     * $data json 所需签名的参数
     * @return string 生成签名
     */
    private function sign($data) {
        $str = "appid=". $data['appid'] ."&mch_id=". $data['mch_id'] ."&nonce_str=". $data['nonce_str']
            ."&out_trade_no=". $data['out_trade_no'];

        $stringKey = $str . '&key=' . $this->key;
        $sign = strtoupper(md5($stringKey));

        return $sign;
    }
}