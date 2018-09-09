<?php
/**
 * 作者：671
 * 时间：2018年3月6日17:58:20
 * 功能：微信公众号常用方法类
 */

require_once "Request.class.php";

class WxVipcn {
    // 配置微信信息
    private $wxAppId;
    private $wxAppSecret;

    public function __construct() {
        $this->wxAppId = WX_APPID;
        $this->wxAppSecret = WX_APPSECRET;
    }

    /**
     * 获取微信access_token
     *
     * @return json access_token
     */
    public function getAccessToken() {
        $link = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential";
        $param = "&appid=". $this->wxAppId ."&secret=". $this->wxAppSecret;
        $url = $link . $param;

        // 判断缓存是否存在
        if (!$data = S('wxAccessToken')) {
            // 表示不存在
            $data = Request::httpGet($url);
            S('wxAccessToken', $data, 7200);
        }

        return json_decode($data);
    }

    /**
     * 获取微信JsapTicket
     *
     * @return json jsapi_ticket
     */
    public function getJsapiTicket() {
        $wxVipcn = new WxVipcn();

        $accessToken = $wxVipcn->getAccessToken();
        $link = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?";
        $param = "access_token=". $accessToken->access_token ."&type=jsapi";
        $url = $link . $param;

        if (!$data = S('wxJsapiTicket')) {
            // 表示不存在
            $data = Request::httpGet($url);
            S('wxJsapiTicket', $data, 7200);
        }

        return json_decode($data);
    }

    /**
     * 获取微信code
     *
     * @param $redirect 重定向到url
     * @param $scope    snsapi_base （直接跳转，只能获取用户openid），snsapi_userinfo（还能获取用户信息）
     * @param $state    附加的参数
     */
    public function getCode($redirect, $scope, $state = "") {
        $link = "https://open.weixin.qq.com/connect/oauth2/authorize?";
        $param = "appid=". $this->wxAppId ."&redirect_uri=". $redirect ."&response_type=code"
            ."&scope=". $scope . "&state=". $state ."#wechat_redirect";

        $url = $link . $param;

        // 重定向
        header("location: $url");
    }

    /**
     * 获取微信的openid
     *
     * @param $code     微信code
     * @return string   openid
     */
    public function getOpenid($code) {
        $link = "https://api.weixin.qq.com/sns/oauth2/access_token?";
        $param = "appid=". $this->wxAppId ."&secret=". $this->wxAppSecret ."&code=". $code ."&grant_type=authorization_code";

        $url = $link . $param;

        $data = Request::httpGet($url);
        $openid = json_decode($data)->openid;

        return $openid;
    }
}