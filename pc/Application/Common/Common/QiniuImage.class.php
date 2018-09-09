<?php

/**
 * 作者：671
 * 时间：2018年1月30日13:11:18
 * 功能：七牛上传图片类
 */

Use Qiniu\Auth;

Vendor('qiniu/autoload');

Class QiniuImage {
    // 七牛秘钥对
    public $accessKey;  // accessKey
    public $secretKey;  // secretKey
    public $bucket;     // 对象名字
    public $host;       // 七牛域名

    public function __construct() {
        // 直接初始化
        $this->accessKey = "V06qa2tY4WVonrYysl4p9SZrJE4vWB8bTuyhzZsz";
        $this->secretKey = "d4k4djs6nR3M5mWZA_PkCmNO94oV9XbI-90shNZM";
        $this->bucket    = "qzxt";
        $this->host      = "http://p3awx75ta.bkt.clouddn.com";
    }

    /**
     * 生成七牛图片凭证
     * @return string 七牛上传图片凭证
     */
    public function qnToken() {
        // 初始化Auth
        $auth = new Auth($this->accessKey, $this->secretKey);

        // 判断缓存是否存在
        if (!session('?up_token')) {
            // 缓存不存在设置缓存
            $upToken = $auth->uploadToken($this->bucket);
            // 配置session
            session(array('name' => 'up_token', 'expire' => 3500));
            session('up_token', $upToken);

        } else {
            $upToken = session('up_token');
        }

        return $upToken;
    }
}