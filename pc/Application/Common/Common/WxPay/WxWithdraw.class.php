<?php
/**
 * 功能：微信提现到余额
 * 作者：@671
 * 时间：2018年1月19日19:00:29
 */

use Common\WxPay\WxPay;

class WxWithdraw extends WxPay {
    private $amount;                // 提现金额
    private $check_name;            // 校验用户姓名选项 NO_CHECK：不校验真实姓名  FORCE_CHECK：强校验真实姓名
    private $desc;                  // 企业付款描述信息
    private $openid;                // 微信用户openid
    private $re_user_name;          // 收款用户姓名
    private $spbill_create_ip;      // 调用接口的机器Ip地址

    public function __construct($amout, $openid, $spbill_create_ip, $desc = "提现成功", $re_user_name = "xxx", $check_name = "NO_CHECK") {
        parent::__construct();

        $this->amount = $amout;                         // 设置提现金额
        $this->openid = $openid;                        // 设置微信用户openid
        $this->spbill_create_ip = $spbill_create_ip;    // 设置ip地址
        $this->desc = $desc;                            // 设置提现描述信息
        $this->re_user_name = $re_user_name;            // 设置收款人用户姓名
        $this->check_name = $check_name;                // 设置校验用户姓名选项
    }

    /**
     * 创建提现
     *
     * @return json 提现返回数据详细：https://pay.weixin.qq.com/wiki/doc/api/tools/mch_pay.php?chapter=14_2
     */
    public function build() {
        $data = $this->config();

        // 请求地址
        $url = "https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/transfers";
        $xml = $this->setXmlData($data);

        $info = Request::xmlPost($url, $xml, true);
        $result = $info;

        return $result;
    }

    /**
     * 配置提现数据
     *
     * @return json 提现数据
     */
    private function config() {
        $data['amount'] = $this->amount;                        // 配置提现金额
        $data['check_name'] = $this->check_name;                // 配置校验用户姓名选项
        $data['desc'] = $this->desc;                            // 配置提现描述
        $data['mch_appid'] = $this->appid;                      // 配置微信appid
        $data['mchid'] = $this->mch_id;                         // 配置商户号
        $data['nonce_str'] = Common::nonceStr(16);              // 配置随机数
        $data['openid'] = $this->openid;                        // 配置用户微信openid
        $data['partner_trade_no'] = Common::createOrder();      // 配置商户订单号
        $data['re_user_name'] = $this->re_user_name;            // 配置收款人用户名字
        $data['spbill_create_ip'] = $this->spbill_create_ip;    // 配置ip地址

        return $data;
    }

    /**
     * 设置提现请求数据
     *
     * @param $data     配置的数据
     * @return xml      需要请求的xml数据
     */
    private function setXmlData($data) {
        $sign = $this->setWithdrawSign($data);

        $xml  = "<xml>";
        $xml .= "<mch_appid>$data[mch_appid]</mch_appid>";
        $xml .= "<mchid>$data[mchid]</mchid>";
        $xml .= "<nonce_str>$data[nonce_str]</nonce_str>";
        $xml .= "<partner_trade_no>$data[partner_trade_no]</partner_trade_no>";
        $xml .= "<openid>$data[openid]</openid>";
        $xml .= "<re_user_name>$data[re_user_name]</re_user_name>";
        $xml .= "<amount>$data[amount]</amount>";
        $xml .= "<check_name>$data[check_name]</check_name>";
        $xml .= "<desc>$data[desc]</desc>";
        $xml .= "<spbill_create_ip>$data[spbill_create_ip]</spbill_create_ip>";
        $xml .= "<sign>$sign</sign>";
        $xml .= "</xml>";

        return $xml;
    }

    /**
     * 设置提现签名
     *
     * @param $data     配置的数据
     * @return string   签名字符串
     */
    private function setWithdrawSign($data) {
        // 签名
        $stringSignTemp = "amount=". $data['amount'] ."&check_name=". $data['check_name'] ."&desc=". $data['desc']
            ."&mch_appid=". $data['mch_appid'] ."&mchid=". $data['mchid'] ."&nonce_str=". $data['nonce_str']
            ."&openid=". $data['openid'] ."&partner_trade_no=". $data['partner_trade_no']
            ."&re_user_name=". $data['re_user_name'] ."&spbill_create_ip=". $data['spbill_create_ip'];

        $stringKey = $stringSignTemp . '&key=' . $this->key;
        $sign = strtoupper(md5($stringKey));

        return $sign;
    }
}