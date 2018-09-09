<?php
/**
 * 微信小程序常用类
 * User: @671
 * Date: 2018/4/4
 * Time: 18:06
 */

require_once "Request.class.php";

Class WxMiniApp {
    private $appid = "";        // 微信小程序appId
    private $appsecret = "";    // 微信小程序appSecret

    // 初始化
    public function __construct($appid, $appsecret) {
        $this->appid = $appid;          // 设置微信小程序appid
        $this->appsecret = $appsecret;  // 设置微信小程序appSecret
    }

    /**
     * 获取微信小程序的openid
     *
     * @param $code     微信小程序获取的code
     * @return object   详细请参考https://developers.weixin.qq.com/miniprogram/dev/api/api-login.html#wxloginobject
     */
    public function getOpenid($code) {
        $link = "https://api.weixin.qq.com/sns/jscode2session?";
        $param = "appid=". $this->appid ."&secret=". $this->appsecret ."&js_code=". $code ."&grant_type=authorization_code";
        $url = $link . $param;

        $result = Request::httpGet($url);

        return json_decode($result);
    }
}