<?php

/**
 * Class TxNote 腾讯云短信类
 */
class TxNote {
    private $appid;     // 腾讯云短信appid
    private $appkey;    // 密码
    public $url;       // 请求地址

    // 构造
    public function __construct() {
        $this->appid  = "1400061415";
        $this->appkey = "8a1095e80086352cfe6b248f48468322";
        $this->url = "https://yun.tim.qq.com/v5/tlssmssvr/sendsms?sdkappid=". $this->appid;
    }

    /**
     * @return int 随机数的结果
     */
    public function getRandom() {
        return rand(100000, 999999);
    }

    /**
     * 发送短信
     * @param $tel 短信
     * @return string 数据存在random字段表示发送成功
     */
    public function sendMsg($tel) {
        $random = $this->getRandom();   // 随机数
        $url = $this->url . "&random=". $random;    // 请求的地址
        $time = time(); // 时间戳
        $photo = $tel; // 手机号码

        $sign = $this->calculateSig($random, $time, $photo);    // 签名

        // 请求的参数
        $data = array(
            "tel"   =>  array(
                "nationcode"    =>  "86",    // 国家码
                "mobile"        =>  $photo   // 手机号码
            ),
            "params"    =>  array($random),
            "tpl_id"    =>  79248,
            "sig"   =>  $sign,
            "time"  =>  $time
        );

        $info = $this->sendCurlPost($url, $data);
        $info = json_decode($info);

        if ($info->result != 0 || $info->errmsg != "OK") {
            return $info;
        }

        $result = $info;
        $result->random = $random;    // 随机数

        return $result;
    }

    /**
     * 发送短信1
     * @param $tel          发送给谁
     * @param $name         会员名字
     * @param $menber_tel   会员的电话
     * @return string       数据存在random字段表示发送成功
     */
    public function sendMsgToAdmin($tel, $name, $menber_tel) {
        $random = $this->getRandom();   // 随机数
        $url = $this->url . "&random=". $random;    // 请求的地址
        $time = time(); // 时间戳
        $photo = $tel; // 手机号码

        $sign = $this->calculateSig($random, $time, $photo);    // 签名

        // 请求的参数
        $data = array(
            "tel"   =>  array(
                "nationcode"    =>  "86",    // 国家码
                "mobile"        =>  $photo   // 手机号码
            ),
            "params"    =>  array(
                $name,
                $menber_tel
            ),
            "tpl_id"    =>  79847,
            "sig"   =>  $sign,
            "time"  =>  $time
        );

        $info = $this->sendCurlPost($url, $data);
        $info = json_decode($info);

        $result = $info;

        return $result;
    }

    /**
     * 生成签名
     * @param $random   随机数
     * @param $time     当前时间戳
     * @param $mobile   手机号码
     * @return string   签名结果
     */
    public function calculateSig($random, $time, $mobile) {
        // 签名需要的字符串
        $sign = "appkey=". $this->appkey ."&random=". $random ."&time=". $time ."&mobile=". $mobile;

        return hash("sha256", $sign);
    }

    /**
     * 发送post请求
     * @param $url              请求地址
     * @param $dataObj          请求内容
     * @return string           应答json字符串
     */
    public function sendCurlPost($url, $dataObj) {

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($dataObj));
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $ret = curl_exec($curl);

        if (false == $ret) {
            // curl_exec failed
            $result = "{ \"result\":" . -2 . ",\"errmsg\":\"" . curl_error($curl) . "\"}";

        } else {
            $rsp = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            if (200 != $rsp) {
                $result = "{ \"result\":" . -1 . ",\"errmsg\":\"". $rsp
                    . " " . curl_error($curl) ."\"}";
            } else {
                $result = $ret;
            }

        }
        curl_close($curl);
        return $result;
    }
}