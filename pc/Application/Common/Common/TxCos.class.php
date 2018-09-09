<?php

/**
 * 作者：671
 * 时间：2018年1月30日13:11:18
 * 功能：腾讯对象
 */
use Qcloud\Cos\Client;
Vendor('CosPhpSdk.cos-autoloader');

Class TxCos {
    public $bucket;     // bucket: 格式（name-appid）
    public $secretId;   // secretid
    public $secretKey;  // secretkey
    public $region;     // 地区

    public function __construct($bucket, $secretId, $secretKey, $region) {
        // 初始化
        $this->bucket = $bucket;
        $this->secretId = $secretId;
        $this->secretKey = $secretKey;
        $this->region = $region;
    }

    /**
     * 文件上传
     *
     * @param $file     表单提交的文件
     * @param $dir      保存的目录
     * @return json     返回JSON数据
     */
    public function upload($file, $dir) {
        $cosClient = new Client($this->config());

        // 获取文件临时路径
        $tmp = $file['tmp_name'];
        // 已二进制方式打开文件
        $fp  = fopen($tmp, 'rb+');

        // 判断类型是否错误
        foreach ($this->type() as $k => $v) {
            if ($file['type'] == $k) {
                $pfx = $v;  // 后缀
                break;
            }
        }
        // 不存在的后缀名
        if (empty($pfx)) return StatusCode::code(7001);
        list($t1, $t2) = explode(' ', microtime());
        $micro = (float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000);
        $key = $dir. '/' .$micro. '.' .$pfx;    // 得到路劲与文件名

        // 上传文件
        $data = $cosClient->putObject(array(
            'Bucket' => $this->bucket,
            'Key' => $key,
            'Body' => $fp
        ));

        // return $data;

        if ($data) {
            //提取有用数据
            // $url = substr(explode('[ObjectURL] => ',(string)$data)[1], 0, -1);
            $result = StatusCode::code(0);
            $result['msg'] = "文件上传成功";
            $result['url'] = $url;

        } else {
            $result = StatusCode::code(7000);
        }

        return $result;
    }

    /**
     * 配置文件类型
     *
     * @return array 返回文件类型
     */
    public function type() {
        return array(
            'image/png'     => 'png',
            'image/jpeg'    => 'jpg',
            'image/pjpeg'   => 'jpg',
            'image/gif'     => 'gif'
        );
    }

    /**
     * 数据配置
     *
     * @return array 配置数据
     */
    private function config() {
        return array(
            'region' => $this->region,
            'credentials' => array(
                'secretId' => $this->secretId,
                'secretKey' => $this->secretKey
            )
        );
    }
}